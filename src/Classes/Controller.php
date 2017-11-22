<?php

namespace App\Classes;

use Slim\Http\Request;
use Slim\Http\Response;

/**
 * Class Controller
 * @package App\Classes
 */
class Controller
{
    /**
     * @var
     */
    private $container;

    public function __construct($container)
    {
        $this->container = $container;
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function home(Request $request, Response $response)
    {
        $response = $this->container['render']->render($response, "index.html", [
            "route" => $request->getUri()->getPath(),
        ]);

        return $response;
    }
}
