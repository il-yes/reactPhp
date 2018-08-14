<?php
/**
 * Created by PhpStorm.
 * User: manu
 * Date: 14/08/18
 * Time: 11:01
 */

namespace App\Controller;


use App\Factory\ChildProcessFactory;
use Psr\Http\Message\ServerRequestInterface;
use React\EventLoop\LoopInterface;
use React\Http\Response;

class IndexController
{
    private $childProcesses;

    public function __construct(ChildProcessFactory $childProcesses)
    {
        $this->childProcesses = $childProcesses;
    }

    public function __invoke(ServerRequestInterface $request, LoopInterface $loop)
    {
        //die(var_dump('ok'));
        $listFiles =  $this->childProcesses->create('ls uploads');
        $listFiles->start($loop);

        $renderPage = $this->childProcesses->create('php templates/index.php');
        $renderPage->start($loop);

        $listFiles->stdout->pipe($renderPage->stdin);

        return new Response(200, ['Content-Type' => 'text/html'], $renderPage->stdout);
    }
}
