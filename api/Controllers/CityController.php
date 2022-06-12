<?php
/**
 * Author: Hieu Nguyen
 * Date: 5/22/2022
 * File: CityController.php
 * Description: file contains City controller class
 */

namespace UsDataAPI\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use UsDataAPI\Controllers\ControllerHelper as Helper;
use UsDataAPI\Models\City;
use UsDataAPI\Models\Election;


class CityController
{
    //retrieve all cities
    public function index(Request $request, Response $response, array $args)
    {
        $result = City::getCities($request);
        return Helper::withJson($response, $result, 200);
    }

    //view a city by id
    public function view(Request $request, Response $response, array $args): Response
    {
        $id = $args['id'];
        $results = City::getCityById($id);
        return Helper::withJson($response, $results, 200);
    }
}