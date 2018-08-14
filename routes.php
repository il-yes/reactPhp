<?php


use App\Controller\IndexController;
use App\Controller\AboutController;
use App\Controller\UploadController;
use App\Controller\PreviewController;
use App\Factory\ChildProcessFactory;
use App\Controller\DownloadController;
use App\Controller\FaviconController;

$childProcessFactory = new ChildProcessFactory(__DIR__);

return[
    '/download/uploads/.*\.(jpg|png)' => new DownloadController($childProcessFactory),
    '/previews/.*\.(jpg|png)'          => new PreviewController($childProcessFactory),
    '/upload'                         => new UploadController($childProcessFactory),
    '/about'                          => new AboutController(),
    'favicon.ico'                     => new FaviconController(),
    ''                                => new IndexController($childProcessFactory),
];
