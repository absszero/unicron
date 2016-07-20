<?php namespace Absszero\Unicron;

class Unicron
{
    private $criteria;
    private $pid_file;

    const UNIX_KILL = 'kill -9';
    const WIN_KILL = 'TASKKILL /PID';

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
`
    public function isRunning()
    {
        return is_file($this->getPidFile());
    }

    public function kill()
    {
        $os_code = strtoupper(substr(PHP_OS, 0, 3));
        $kill = ('WIN' === $os_code) ? self::WIN_KILL : self::UNIX_KILL;

        if ($this->isRunning()) {
            $pid = $this->getPid();
            $command = escapeshellcmd("$kill $pid");
            exec($command);
        }

        return $command;
    }

    public function setPid($pid = null)
    {
        if (is_null($pid)) {
            $pid = getmypid();
        }
        return file_put_contents($this->getPidFile(), $pid);
    }

    public function getPid()
    {
        return file_get_contents($this->getPidFile());
    }

    public function withdraw()
    {
        if ($this->isRunning()) {
            unlink($this->getPidFile());
        }
    }

    public function __destruct()
    {
        $this->withdraw();
    }
}
