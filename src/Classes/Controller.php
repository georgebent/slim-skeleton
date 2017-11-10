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
        $this->dbDir = 'sqlite:../database/portfolio.sqlite';
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

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function about(Request $request, Response $response)
    {
        $query =  "SELECT * FROM works;";
        $results = $this->db()->query($query);
        $response = $this->container['render']->render($response, "about.html", [
            "route" => $request->getUri()->getPath(),
            "works" => $results,
        ]);
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     */
    public function contacts(Request $request, Response $response)
    {
        $response = $this->container['render']->render($response, "contacts.html", [
            "route" => $request->getUri()->getPath(),
        ]);

        return $response;
    }

    /**
     * @return \PDO
     */
    public function db()
    {
        $dbh = new \PDO($this->dbDir) or die("cannot open the database");
        return $dbh;
    }
}
