<?php namespace Absszero\Unicron\Test;

use Absszero\Unicron\Unicron;

/**
 * @covers Absszero\Unicron\Unicron
 */
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
    }

    public function testPid()
    {
        $pid = 99999999999;
        $this->unicron->setPid($pid);
        $this->assertEquals($pid, $this->unicron->getPid());
    }

    public function testWithDraw()
    {
        $file = $this->unicron->getPidFile();
        $this->unicron = null;

        $this->assertFalse(file_exists($file));
    }

}
