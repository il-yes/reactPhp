<?php
/**
 * Created by PhpStorm.
 * User: manu
 * Date: 10/08/18
 * Time: 15:36
 */

namespace App;


use Psr\Http\Message\ServerRequestInterface;
use React\EventLoop\LoopInterface;
use React\Http\Response;

class Router
{
    private $routes = [];

    /**
     * @var LoopInterface
     */
    private $loop;

    public function __construct(LoopInterface $loop)
    {
        $this->loop = $loop;
    }

    /**
     * @param ServerRequestInterface $request
     * @return \Closure
     */
    public function __invoke(ServerRequestInterface $request)
    {
        $path = trim($request->getUri()->getPath());

        foreach ($this->routes as $pattern => $handler) {

            if(preg_match("~$pattern$~", $path)) {
                return $handler($request, $this->loop);
            }
        }

        return $this->notFound($path);
    }


    /**
     * @param $path
     * @param callable $handler
     */
    public function add($path, callable $handler)
    {
        $this->routes[$path] = $handler;
    }


    /**
     * @param $filename
     */
    public function load($filename)
    {
        $routes = require $filename;

        foreach ($routes as $path => $handler) {
            $this->add($path, $handler);
        }
    }


    /**
     * @param $path
     * @return \Closure
     */
    private function notFound($path)
    {
        return function () use ($path){
            return new Response(404, ['Content-Type' => 'text/plain'], "No request handler found for $path");
        };

    }
}
