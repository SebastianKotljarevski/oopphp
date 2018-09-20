<?php

namespace seku\Guess;

/**
 * A class supporting the game Dice100.
 */
class Dice extends MakeDice
{
    /**
     * @var int $count          Count for which IF to enter.
     * @var int $playerScore    Keeps track of players score.
     * @var int $tempScore      temporary variable used for storing a temporary value
     */

    private $count;
    private $playerScore;
    public $tempScore;

    /**
     * Set function to set var count..
     */
    public function setCount($arg)
    {
        $this->count = $arg;
    }

    /**
     * Get function to get count.
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * get function to get player score.
     */
    public function getPlayerScore()
    {
        return $this->playerScore;
    }

    /**
     * set function to get player score.
     */
    public function setPlayerScore()
    {
        $this->playerScore += $this->tempScore;
    }

    /**
     * get function to get temp score.
     */
    public function getTempScore()
    {
        return $this->tempScore;
    }

    /**
     * set function to set temp score.
     */
    public function setTempScore($score)
    {
        $this->tempScore = $score;
    }

    /**
     * set function to set temp score to zero.
     */
    public function setTempScoreToZero()
    {
        $this->tempScore = 0;
    }
}
