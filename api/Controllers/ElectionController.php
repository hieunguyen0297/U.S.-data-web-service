<?php
/**
 * Author: Hieu Nguyen
 * Date: 5/22/2022
 * File: ElectionController.php
 * Description: file contains Election controller class
 */

namespace UsDataAPI\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use UsDataAPI\Controllers\ControllerHelper as Helper;
use UsDataAPI\Models\Election;


class ElectionController
{
    //retrieve all election parties
    public function index(Request $request, Response $response, array $args)
    {
        $result = Election::getElections();
        return Helper::withJson($response, $result, 200);
    }

    //view an election party by id
    public function view(Request $request, Response $response, array $args): Response
    {
        $id = $args['id'];
        $results = Election::getElectionById($id);
        return Helper::withJson($response, $results, 200);
    }

    //view states by election
    public function viewStates(Request $request, Response $response, array $args):
    Response
    {
        $id = $args['id'];
        $results = Election::getStatesByElection($id);
        return Helper::withJson($response, $results, 200);
    }
}