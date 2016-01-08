<?php namespace Absszero\Unicron;

class Unicron
{
    private $criteria;
    private $pid_file;

    public function __construct($criteria, $pid_storage = null)
    {
        if (is_null($pid_storage)) {
            $pid_storage = sys_get_temp_dir();
        }

        if (!is_dir($pid_storage)) {
            mkdir($pid_storage, 0775, true);
        }

        $this->criteria = md5($criteria);
        $this->pid_file = $pid_storage .'/'. $this->criteria;

    }

    public function getPidFile()
    {
        return $this->pid_file;
    }

    public function isRunning()
    {
        return is_file($this->pid_file);
    }

    public function kill()
    {
        $windows = ('WIN' === strtoupper(substr(PHP_OS, 0, 3)));

        if (!$windows and $this->isRunning()) {
            $pid = $this->getPid();
            exec("kill -9 $pid");
        }
    }

    public function setPid($pid = null)
    {
        if (is_null($pid)) {
            $pid = getmypid();
        }

        return file_put_contents($this->pid_file, $pid);
    }

    public function getPid()
    {
        return (int)file_get_contents($this->pid_file);
    }

    public function withdraw()
    {
        if ($this->isRunning()) {
            unlink($this->pid_file);
        }
    }

    public function __destruct()
    {
        $this->withdraw();
    }
}