<?php
/**
 * Created by PhpStorm.
 * User: manu
 * Date: 14/08/18
 * Time: 11:36
 */

namespace App\Factory;


use React\ChildProcess\Process;

class ChildProcessFactory
{

    /**
     * @var string
     */
    private $currentWorkingDir;

    public function __construct($currentWorkingDirectory)
    {
        $this->currentWorkingDirectory = $currentWorkingDirectory;
    }

    public function create($command)
    {
        return new Process($command, $this->currentWorkingDirectory);
    }
}
