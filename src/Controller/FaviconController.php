<?php
/**
 * Created by PhpStorm.
 * User: manu
 * Date: 14/08/18
 * Time: 12:03
 */

namespace App\Controller;


use Psr\Http\Message\ServerRequestInterface;
use React\Http\Response;

class FaviconController
{
    public function __invoke(ServerRequestInterface $request)
    {
        return new Response(200, ['Content-Type' => 'image/x-icon']);
    }
}
