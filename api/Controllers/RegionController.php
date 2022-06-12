<?php
/**
 * Author: Hieu Nguyen
 * Date: 5/22/2022
 * File: RegionController.php
 * Description: file contains Region controller
 */

namespace UsDataAPI\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use UsDataAPI\Controllers\ControllerHelper as Helper;
use UsDataAPI\Models\Region;


class RegionController
{
    //retrieve all regions
    public function index(Request $request, Response $response, array $args)
    {
        $result = Region::getRegions();
        return Helper::withJson($response, $result, 200);
    }

    //view a region by id
    public function view(Request $request, Response $response, array $args): Response
    {
        $id = $args['id'];
        $results = Region::getRegionById($id);
        return Helper::withJson($response, $results, 200);
    }

    //view states of a region
    public function viewStates(Request $request, Response $response, array $args):
    Response
    {
        $id = $args['id'];
        $results = Region::getStatesByRegion($id);
        return Helper::withJson($response, $results, 200);
    }

}