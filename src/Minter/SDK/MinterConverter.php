<?php

namespace Minter\SDK;

class MinterConverter
{
    /**
     * PIP in BIP
     */
    const DEFAULT = '1000000000000000000';

    /**
     * Convert value
     *
     * @param string $num
     * @param string $to
     * @return string
     */
    public static function convertValue(string $num, string $to)
    {
        if ($to === 'pip') {
            return bcmul(self::DEFAULT, $num);
        } else if ($to === 'bip') {
            return rtrim(rtrim(bcdiv($num, self::DEFAULT, 25), '0'), '.');
        }
    }

    /**
     * Add nulls to coin name
     *
     * @param string $symbol
     * @return string
     */
    public static function convertCoinName(string $symbol): string
    {
        return $symbol  . str_repeat(chr(0), 10 - strlen($symbol));
    }
}