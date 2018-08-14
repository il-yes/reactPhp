<?php
/**
 * Created by PhpStorm.
 * User: manu
 * Date: 14/08/18
 * Time: 11:21
 */

namespace App\Controller;

use App\Factory\ChildProcessFactory;
use Psr\Http\Message\ServerRequestInterface;
use React\EventLoop\LoopInterface;
use React\Http\Response;


class PreviewController
{
    public $childProcesses;

    public function __construct(ChildProcessFactory $childProcesses)
    {
        $this->childProcesses = $childProcesses;
    }

    public function __invoke(ServerRequestInterface $request, LoopInterface $loop)
    {
        $fileName = trim($request->getUri()->getPath(), '/');
        $ext = pathinfo($fileName, PATHINFO_EXTENSION);

        $readFile = $this->childProcesses->create("cat $fileName");
        $readFile->start($loop);

        return new Response(200, ['Content-Type' => "image/$ext"], $readFile->stdout);
    }
}
