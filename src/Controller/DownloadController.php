<?php
/**
 * Created by PhpStorm.
 * User: manu
 * Date: 14/08/18
 * Time: 11:46
 */

namespace App\Controller;


use App\Factory\ChildProcessFactory;
use Psr\Http\Message\ServerRequestInterface;
use React\EventLoop\LoopInterface;
use React\Http\Response;

class DownloadController
{
    private $childProcesses;

    public function __construct(ChildProcessFactory $childProcesses)
    {
        $this->childProcesses = $childProcesses;
    }

    public function __invoke(ServerRequestInterface $request, LoopInterface $loop)
    {
        $fileName = str_replace('download/', '', trim($request->getUri()->getPath(), '/'));

        $readFile = $this->childProcesses->create("cat $fileName");
        $readFile->start($loop);

        return new Response(200, ['Content-Disposition' => 'attachment'], $readFile->stdout);
    }
}
