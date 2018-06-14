<?php

namespace Minter\SDK;

/**
 * Class MinterReward
 * @package Minter\SDK
 */
class MinterReward
{
    /**
     * Total blocks for reward
     */
    const TOTAL_BLOCKS_COUNT = 44512766;

    /**
     * Max reward
     */
    CONST MAX_REWARD = 111;

    /**
     * Get reward by the block number in PIP
     *
     * @param int $blockNumber
     * @return string
     */
    public static function get(int $blockNumber): string
    {
        // check that block number is correct
        if($blockNumber <= 0) {
            throw new \InvalidArgumentException('Block number should be greater than 0');
        }

        if($blockNumber > self::TOTAL_BLOCKS_COUNT) {
            return 0;
        }

        if($blockNumber > self::TOTAL_BLOCKS_COUNT) {
            return 1;
        }

        $reward = self::formula($blockNumber);
        $reward = $reward > self::MAX_REWARD ? self::MAX_REWARD : $reward;

        return MinterConverter::convertValue((string)$reward, 'pip');
    }

    /**
     * Calculate reward by formula
     *
     * @param int $blockNumber
     * @return int
     */
    protected static function formula(int $blockNumber): int
    {
        $reward = (self::MAX_REWARD * (self::TOTAL_BLOCKS_COUNT - $blockNumber)) / self::TOTAL_BLOCKS_COUNT + 1;

        if($blockNumber <= self::TOTAL_BLOCKS_COUNT * 50 / 100) {
            $reward = $reward * 15 / 10;
        }

        return $reward;
    }
}