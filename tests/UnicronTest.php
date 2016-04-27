<?php namespace Absszero\Unicron\Test;

use Absszero\Unicron\Unicron;

class UnicronTest extends \PHPUnit_Framework_TestCase
{
    protected $unicron;
    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     *
     * @access protected
     */
    protected function setUp()
    {
        $this->unicron = new Unicron('test');
    }

    public function testRunningStates()
    {
        $this->unicron->setPid();
        $this->assertTrue($this->unicron->isRunning());

        $this->unicron->withdraw();
        $this->assertFalse($this->unicron->isRunning());
    }
}