<?php

namespace Minter\SDK;
use Elliptic\EC;
use Minter\Library\Helper;
use Web3p\RLP\RLP;

/**
 * Class MinterCoupon
 * @package Minter\SDK
 */
class MinterCoupon
{
    /**
     * @var RLP
     */
    protected $rlp;

    /**
     * @var string
     */
    protected $minterAddress;

    /**
     * Coupon passphrase
     *
     * @var string
     */
    protected $passphrase;

    /**
     * Coupon structure
     *
     * @var array
     */
    protected $structure = [
        'nonce',
        'dueBlock',
        'coin',
        'value',
        'lock',
        'v',
        'r',
        's'
    ];

    /**
     * Define RLP, password and encode/decode coupon
     *
     * MinterCoupon constructor.
     * @param $couponOrAddress
     * @param string $passphrase
     */
    public function __construct($couponOrAddress, string $passphrase)
    {
        $this->rlp = new RLP;

        $this->passphrase = $passphrase;

        if(is_array($couponOrAddress)) {
            $this->structure = $this->defineProperties($couponOrAddress);
        }

        if(is_string($couponOrAddress)) {
            $this->minterAddress = $couponOrAddress;
        }
    }

    /**
     * Get
     *
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        return $this->structure[$name];
    }

    /**
     *
     *
     * @param string $privateKey
     * @return string
     */
    public function sign(string $privateKey): string
    {
        // create message hash and passphrase by first 4 fields
        $msgHash = $this->serialize(
            array_slice($this->structure, 0, 4)
        );

        $passphrase = hash('sha256', $this->passphrase);

        // create elliptic curve and sign
        $signature = $this->createSignature($msgHash, $passphrase);

        // define lock field
        $this->structure['lock'] = $this->formatLockFromSignature($signature);

        // create message hash with lock field
        $msgHashWithLock = $this->serialize(
            array_slice($this->structure, 0, 5)
        );

        // create signature with msg and private key
        $signature = $this->createSignature($msgHashWithLock, $privateKey);

        // update structure
        $this->structure = array_merge($this->structure, Helper::formatSignatureParams($signature));

        // rlp encode data and add Minter wallet prefix
        return Helper::addWalletPrefix(
            $this->rlp->encode($this->structure)->toString('hex')
        );
    }

    /**
     * Create proof by address and passphrase
     *
     * @return string
     * @throws \Exception
     */
    public function createProof(): string
    {
        if(!$this->minterAddress) {
            throw new \Exception('Minter address is not defined');
        }

        // create msg hash of address
        $minterAddress = [hex2bin(Helper::removeWalletPrefix($this->minterAddress))];
        $addressHash = $this->serialize($minterAddress);

        // get SHA 256 hash of password and create EC signature
        $passphrase = hash('sha256', $this->passphrase);
        $signature = $this->createSignature($addressHash, $passphrase);

        // return formatted proof
        return bin2hex(
            $this->formatLockFromSignature($signature)
        );
    }

    /**
     * Merge input fields with structure
     *
     * @param array $coupon
     * @return array
     * @throws \Exception
     */
    protected function defineProperties(array $coupon): array
    {
        $structure = array_flip($this->structure);

        if(!$this->validateFields($coupon)) {
            throw new \Exception('Invalid fields');
        }

        return array_merge($structure, $this->encode($coupon));
    }

    /**
     * Encode input fields
     *
     * @param array $coupon
     * @return array
     */
    protected function encode(array $coupon): array
    {
        return [
            'nonce' => $coupon['nonce'],

            'dueBlock' => $coupon['dueBlock'],

            'coin' => MinterConverter::convertCoinName($coupon['coin']),

            'value' => MinterConverter::convertValue($coupon['value'], 'pip'),
        ];
    }

    /**
     * Create message Keccak hash from structure fields limited by number of fields
     *
     * @return array
     */
    protected function serialize($data): string
    {
        // create msg hash with lock field
        $msgHash = $this->rlp->encode($data)->toString('hex');

        return Helper::createKeccakHash($msgHash);
    }

    /**
     * Create EC signature
     *
     * @param string $msg
     * @param string $passphrase
     * @return EC\Signature
     */
    protected function createSignature(string $msg, string $passphrase): EC\Signature
    {
        $ellipticCurve = new EC('secp256k1');

        return $ellipticCurve->sign($msg, $passphrase, 'hex', ['canonical' => true]);
    }

    /**
     * Validate that input fields are correct
     *
     * @param array $fields
     * @return bool
     */
    protected function validateFields(array $fields): bool
    {
        $structure = array_flip($this->structure);

        foreach ($fields as $field => $fieldValue) {
            if(!isset($structure[$field])) {
                return false;
            }
        }

        return true;
    }

    /**
     * Prepare lock field
     *
     * @param EC\Signature $signature
     * @return string
     */
    protected function formatLockFromSignature(EC\Signature $signature): string
    {
        $recovery = $signature->recoveryParam === 1 ? '01' : '00';

        return hex2bin($signature->r->toString('hex') . $signature->s->toString('hex') . $recovery);
    }
}