<?php
/**
 * Created by PhpStorm.
 * User: manu
 * Date: 14/08/18
 * Time: 11:27
 */

namespace App\Controller;


use React\Http\Response;

class AboutController
{
    public function __invoke()
    {
        return new Response(200, ['Content-Type' => 'text/html'], file_get_contents(__DIR__ .'/../../templates/about.html'));
    }
}
