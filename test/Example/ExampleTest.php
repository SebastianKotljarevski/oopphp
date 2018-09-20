<?php

namespace seku\Guess;

use PHPUnit\Framework\TestCase;

/**
 * Example test class.
 */
class ExampleTest extends TestCase
{
    /**
     * Just assert something is true.
     */
    public function testTrue()
    {
        $this->assertTrue(true);
    }

    /**
     * Test for SetCount().
     */
    public function testSetCount()
    {
        $dice = new Dice();
        $this->assertEquals(@$dice->setCount(0), null);
    }

    /**
     * Test for setPlayerScore().
     */
    public function testSetPlayerScore()
    {
        $dice = new Dice();
        $this->assertEquals(@$dice->setPlayerScore(0), null);
    }

    /**
     * Test for setTempScore().
     */
    public function testSetTempScore()
    {
        $dice = new Dice();
        $this->assertEquals(@$dice->setTempScore(0), null);
    }

    /**
     * Test for setTempScoreToZero().
     */
    public function testSetTempScoreToZero()
    {
        $dice = new Dice();
        $this->assertEquals(@$dice->setTempScoreToZero(0), null);
    }

    /**
     * Test for getCount().
     */
    public function testGetCount()
    {
        $dice = new Dice();
        $this->assertEquals(@$dice->getCount(), null);
    }

    /**
     * Test for getPlayerScore().
     */
    public function testGetPlayerScore()
    {
        $dice = new Dice();
        $this->assertEquals(@$dice->getPlayerScore(), null);
    }

    /**
     * Test for getTempScore().
     */
    public function testGetTempScore()
    {
        $dice = new Dice();
        $this->assertEquals(@$dice->getTempScore(), null);
    }
}
