<?php
/**
 * Author: Hieu Nguyen
 * Date: 5/22/2022
 * File: RatingController.php
 * Description: file contains rating controller class
 */

namespace UsDataAPI\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use UsDataAPI\Controllers\ControllerHelper as Helper;
use UsDataAPI\Models\Rating;


class RatingController {
    //retrieve all ratings
    public function index(Request $request, Response $response, array $args)
    {
        $result = Rating::getRatings();
        return Helper::withJson($response, $result, 200);
    }

    //view a rating by id
    public function view(Request $request, Response $response, array $args): Response
    {
        $id = $args['id'];
        $results = Rating::getRatingById($id);
        return Helper::withJson($response, $results, 200);
    }

    //view cities by rating
    public function viewCities(Request $request, Response $response, array $args):
    Response
    {
        $id = $args['id'];
        $results = Rating::getCitiesByRating($id);
        return Helper::withJson($response, $results, 200);
    }
}
