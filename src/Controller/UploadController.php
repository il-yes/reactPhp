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
use React\ChildProcess\Process;
use React\EventLoop\LoopInterface;
use React\Http\Response;

class UploadController
{
    private $childProcesses;

    public function __construct(ChildProcessFactory $childProcesses)
    {
        $this->childProcesses = $childProcesses;
    }

    public function __invoke(ServerRequestInterface $request, LoopInterface $loop)
    {
        /** @var \Psr\Http\Message\UploadedFileInterface $file */
        $file = $request->getUploadedFiles()['file'];
        $fileName = strtolower($file->getClientFilename());

        $saveUpload = $this->childProcesses->create("cat > uploads/$fileName");
        $saveUpload->start($loop);
        $saveUpload->stdin->end($file->getStream()->getContents());

        $saveUpload->stdin->on('close', function () use ($fileName, $loop) {
                $this->createPreview($fileName, $loop);
            }
        );


        return new Response(302, ['Location' => '/']);
    }


    private function createPreview($fileName, LoopInterface $loop)
    {
        $createPreview = $this->childProcesses->create("convert uploads/$fileName -resize 128x128 previews/$fileName");
        $createPreview->start($loop);
    }
}
