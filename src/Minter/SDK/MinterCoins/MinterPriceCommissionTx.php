<?php
namespace Minter\SDK\MinterCoins;

use Minter\Contracts\MinterTxInterface;
use Minter\Library\Helper;
use Minter\SDK\MinterConverter;
use Minter\SDK\MinterPrefix;

/**
 * Class MinterPriceCommissionTx
 * @package Minter\SDK\MinterCoins
 */
class MinterPriceCommissionTx extends MinterCoinTx implements MinterTxInterface
{
    public $pubKey;
    public $height;
    public $coin;
    public $payloadByte;
    public $send;
    public $buyBancor;
    public $sellBancor;
    public $sellAllBancor;
    public $buyPoolBase;
    public $buyPoolDelta;
    public $sellPoolBase;
    public $sellPoolDelta;
    public $sellAllPoolBase;
    public $sellAllPoolDelta;
    public $createTicker3;
    public $createTicker4;
    public $createTicker5;
    public $createTicker6;
    public $createTicker7to10;
    public $createCoin;
    public $createToken;
    public $recreateCoin;
    public $recreateToken;
    public $declareCandidacy;
    public $delegate;
    public $unbond;
    public $redeemCheck;
    public $setCandidateOn;
    public $setCandidateOff;
    public $createMultisig;
    public $multisendBase;
    public $multisendDelta;
    public $editCandidate;
    public $setHaltBlock;
    public $editTickerOwner;
    public $editMultisig;
    public $editCandidatePublicKey;
    public $createSwapPool;
    public $addLiquidity;
    public $removeLiquidity;
    public $editCandidateCommission;
    public $burnToken;
    public $mintToken;
    public $voteCommission;
    public $voteUpdate;

    const TYPE = 32;

    /**
     * MinterPriceCommissionTx constructor.
     * @param $pubKey
     * @param $height
     * @param $coin
     * @param $payloadByte
     * @param $send
     * @param $buyBancor
     * @param $sellBancor
     * @param $sellAllBancor
     * @param $buyPoolBase
     * @param $buyPoolDelta
     * @param $sellPoolBase
     * @param $sellPoolDelta
     * @param $sellAllPoolBase
     * @param $sellAllPoolDelta
     * @param $createTicker3
     * @param $createTicker4
     * @param $createTicker5
     * @param $createTicker6
     * @param $createTicker7to10
     * @param $createCoin
     * @param $createToken
     * @param $recreateCoin
     * @param $recreateToken
     * @param $declareCandidacy
     * @param $delegate
     * @param $unbond
     * @param $redeemCheck
     * @param $setCandidateOn
     * @param $setCandidateOff
     * @param $createMultisig
     * @param $multisendBase
     * @param $multisendDelta
     * @param $editCandidate
     * @param $setHaltBlock
     * @param $editTickerOwner
     * @param $editMultisig
     * @param $editCandidatePublicKey
     * @param $createSwapPool
     * @param $addLiquidity
     * @param $removeLiquidity
     * @param $editCandidateCommission
     * @param $burnToken
     * @param $mintToken
     * @param $voteCommission
     * @param $voteUpdate
     */
    public function __construct(
        $pubKey,
        $height,
        $coin,
        $payloadByte,
        $send,
        $buyBancor,
        $sellBancor,
        $sellAllBancor,
        $buyPoolBase,
        $buyPoolDelta,
        $sellPoolBase,
        $sellPoolDelta,
        $sellAllPoolBase,
        $sellAllPoolDelta,
        $createTicker3,
        $createTicker4,
        $createTicker5,
        $createTicker6,
        $createTicker7to10,
        $createCoin,
        $createToken,
        $recreateCoin,
        $recreateToken,
        $declareCandidacy,
        $delegate,
        $unbond,
        $redeemCheck,
        $setCandidateOn,
        $setCandidateOff,
        $createMultisig,
        $multisendBase,
        $multisendDelta,
        $editCandidate,
        $setHaltBlock,
        $editTickerOwner,
        $editMultisig,
        $editCandidatePublicKey,
        $createSwapPool,
        $addLiquidity,
        $removeLiquidity,
        $editCandidateCommission,
        $burnToken,
        $mintToken,
        $voteCommission,
        $voteUpdate
    ) {
        $this->pubKey                  = $pubKey;
        $this->height                  = $height;
        $this->coin                    = $coin;
        $this->payloadByte             = $payloadByte;
        $this->send                    = $send;
        $this->buyBancor               = $buyBancor;
        $this->sellBancor              = $sellBancor;
        $this->sellAllBancor           = $sellAllBancor;
        $this->buyPoolBase             = $buyPoolBase;
        $this->buyPoolDelta            = $buyPoolDelta;
        $this->sellPoolBase            = $sellPoolBase;
        $this->sellPoolDelta           = $sellPoolDelta;
        $this->sellAllPoolBase         = $sellAllPoolBase;
        $this->sellAllPoolDelta        = $sellAllPoolDelta;
        $this->createTicker3           = $createTicker3;
        $this->createTicker4           = $createTicker4;
        $this->createTicker5           = $createTicker5;
        $this->createTicker6           = $createTicker6;
        $this->createTicker7to10       = $createTicker7to10;
        $this->createCoin              = $createCoin;
        $this->createToken             = $createToken;
        $this->recreateCoin            = $recreateCoin;
        $this->recreateToken           = $recreateToken;
        $this->declareCandidacy        = $declareCandidacy;
        $this->delegate                = $delegate;
        $this->unbond                  = $unbond;
        $this->redeemCheck             = $redeemCheck;
        $this->setCandidateOn          = $setCandidateOn;
        $this->setCandidateOff         = $setCandidateOff;
        $this->createMultisig          = $createMultisig;
        $this->multisendBase           = $multisendBase;
        $this->multisendDelta          = $multisendDelta;
        $this->editCandidate           = $editCandidate;
        $this->setHaltBlock            = $setHaltBlock;
        $this->editTickerOwner         = $editTickerOwner;
        $this->editMultisig            = $editMultisig;
        $this->editCandidatePublicKey  = $editCandidatePublicKey;
        $this->createSwapPool          = $createSwapPool;
        $this->addLiquidity            = $addLiquidity;
        $this->removeLiquidity         = $removeLiquidity;
        $this->editCandidateCommission = $editCandidateCommission;
        $this->burnToken               = $burnToken;
        $this->mintToken               = $mintToken;
        $this->voteCommission          = $voteCommission;
        $this->voteUpdate              = $voteUpdate;
    }

    /**
     * Prepare tx data for signing
     *
     * @return array
     */
    function encodeData(): array
    {
        return [
            hex2bin(Helper::removePrefix($this->pubKey, MinterPrefix::PUBLIC_KEY)),
            $this->height,
            $this->coin,
            MinterConverter::convertToPip($this->payloadByte),
            MinterConverter::convertToPip($this->send),
            MinterConverter::convertToPip($this->buyBancor),
            MinterConverter::convertToPip($this->sellBancor),
            MinterConverter::convertToPip($this->sellAllBancor),
            MinterConverter::convertToPip($this->buyPoolBase),
            MinterConverter::convertToPip($this->buyPoolDelta),
            MinterConverter::convertToPip($this->sellPoolBase),
            MinterConverter::convertToPip($this->sellPoolDelta),
            MinterConverter::convertToPip($this->sellAllPoolBase),
            MinterConverter::convertToPip($this->sellAllPoolDelta),
            MinterConverter::convertToPip($this->createTicker3),
            MinterConverter::convertToPip($this->createTicker4),
            MinterConverter::convertToPip($this->createTicker5),
            MinterConverter::convertToPip($this->createTicker6),
            MinterConverter::convertToPip($this->createTicker7to10),
            MinterConverter::convertToPip($this->createCoin),
            MinterConverter::convertToPip($this->createToken),
            MinterConverter::convertToPip($this->recreateCoin),
            MinterConverter::convertToPip($this->recreateToken),
            MinterConverter::convertToPip($this->declareCandidacy),
            MinterConverter::convertToPip($this->delegate),
            MinterConverter::convertToPip($this->unbond),
            MinterConverter::convertToPip($this->redeemCheck),
            MinterConverter::convertToPip($this->setCandidateOn),
            MinterConverter::convertToPip($this->setCandidateOff),
            MinterConverter::convertToPip($this->createMultisig),
            MinterConverter::convertToPip($this->multisendBase),
            MinterConverter::convertToPip($this->multisendDelta),
            MinterConverter::convertToPip($this->editCandidate),
            MinterConverter::convertToPip($this->setHaltBlock),
            MinterConverter::convertToPip($this->editTickerOwner),
            MinterConverter::convertToPip($this->editMultisig),
            MinterConverter::convertToPip($this->editCandidatePublicKey),
            MinterConverter::convertToPip($this->createSwapPool),
            MinterConverter::convertToPip($this->addLiquidity),
            MinterConverter::convertToPip($this->removeLiquidity),
            MinterConverter::convertToPip($this->editCandidateCommission),
            MinterConverter::convertToPip($this->burnToken),
            MinterConverter::convertToPip($this->mintToken),
            MinterConverter::convertToPip($this->voteCommission),
            MinterConverter::convertToPip($this->voteUpdate)
        ];
    }


    function decodeData()
    {
        $this->pubKey                  = MinterPrefix::PUBLIC_KEY . $this->pubKey;
        $this->height                  = (int)hexdec($this->height);
        $this->coin                    = hexdec($this->coin);
        $this->payloadByte             = MinterConverter::convertToBase(Helper::hexDecode($this->payloadByte));
        $this->send                    = MinterConverter::convertToBase(Helper::hexDecode($this->send));
        $this->buyBancor               = MinterConverter::convertToBase(Helper::hexDecode($this->buyBancor));
        $this->sellBancor              = MinterConverter::convertToBase(Helper::hexDecode($this->sellBancor));
        $this->sellAllBancor           = MinterConverter::convertToBase(Helper::hexDecode($this->sellAllBancor));
        $this->buyPoolBase             = MinterConverter::convertToBase(Helper::hexDecode($this->buyPoolBase));
        $this->buyPoolDelta            = MinterConverter::convertToBase(Helper::hexDecode($this->buyPoolDelta));
        $this->sellPoolBase            = MinterConverter::convertToBase(Helper::hexDecode($this->sellPoolBase));
        $this->sellPoolDelta           = MinterConverter::convertToBase(Helper::hexDecode($this->sellPoolDelta));
        $this->sellAllPoolBase         = MinterConverter::convertToBase(Helper::hexDecode($this->sellAllPoolBase));
        $this->sellAllPoolDelta        = MinterConverter::convertToBase(Helper::hexDecode($this->sellAllPoolDelta));
        $this->createTicker3           = MinterConverter::convertToBase(Helper::hexDecode($this->createTicker3));
        $this->createTicker4           = MinterConverter::convertToBase(Helper::hexDecode($this->createTicker4));
        $this->createTicker5           = MinterConverter::convertToBase(Helper::hexDecode($this->createTicker5));
        $this->createTicker6           = MinterConverter::convertToBase(Helper::hexDecode($this->createTicker6));
        $this->createTicker7to10       = MinterConverter::convertToBase(Helper::hexDecode($this->createTicker7to10));
        $this->createCoin              = MinterConverter::convertToBase(Helper::hexDecode($this->createCoin));
        $this->createToken             = MinterConverter::convertToBase(Helper::hexDecode($this->createToken));
        $this->recreateCoin            = MinterConverter::convertToBase(Helper::hexDecode($this->recreateCoin));
        $this->recreateToken           = MinterConverter::convertToBase(Helper::hexDecode($this->recreateToken));
        $this->declareCandidacy        = MinterConverter::convertToBase(Helper::hexDecode($this->declareCandidacy));
        $this->delegate                = MinterConverter::convertToBase(Helper::hexDecode($this->delegate));
        $this->unbond                  = MinterConverter::convertToBase(Helper::hexDecode($this->unbond));
        $this->redeemCheck             = MinterConverter::convertToBase(Helper::hexDecode($this->redeemCheck));
        $this->setCandidateOn          = MinterConverter::convertToBase(Helper::hexDecode($this->setCandidateOn));
        $this->setCandidateOff         = MinterConverter::convertToBase(Helper::hexDecode($this->setCandidateOff));
        $this->createMultisig          = MinterConverter::convertToBase(Helper::hexDecode($this->createMultisig));
        $this->multisendBase           = MinterConverter::convertToBase(Helper::hexDecode($this->multisendBase));
        $this->multisendDelta           = MinterConverter::convertToBase(Helper::hexDecode($this->multisendDelta));
        $this->editCandidate           = MinterConverter::convertToBase(Helper::hexDecode($this->editCandidate));
        $this->setHaltBlock            = MinterConverter::convertToBase(Helper::hexDecode($this->setHaltBlock));
        $this->editTickerOwner         = MinterConverter::convertToBase(Helper::hexDecode($this->editTickerOwner));
        $this->editMultisig            = MinterConverter::convertToBase(Helper::hexDecode($this->editMultisig));
        $this->editCandidatePublicKey  = MinterConverter::convertToBase(Helper::hexDecode($this->editCandidatePublicKey));
        $this->createSwapPool          = MinterConverter::convertToBase(Helper::hexDecode($this->createSwapPool));
        $this->addLiquidity            = MinterConverter::convertToBase(Helper::hexDecode($this->addLiquidity));
        $this->removeLiquidity         = MinterConverter::convertToBase(Helper::hexDecode($this->removeLiquidity));
        $this->editCandidateCommission = MinterConverter::convertToBase(Helper::hexDecode($this->editCandidateCommission));
        $this->burnToken               = MinterConverter::convertToBase(Helper::hexDecode($this->burnToken));
        $this->mintToken               = MinterConverter::convertToBase(Helper::hexDecode($this->mintToken));
        $this->voteCommission          = MinterConverter::convertToBase(Helper::hexDecode($this->voteCommission));
        $this->voteUpdate              = MinterConverter::convertToBase(Helper::hexDecode($this->voteUpdate));
    }
}