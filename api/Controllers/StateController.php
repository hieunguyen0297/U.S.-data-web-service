<?php
/**
 * Author: Hieu Nguyen
 * Date: 5/22/2022
 * File: StateController.php
 * Description: create state controller
 */

namespace UsDataAPI\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;
use UsDataAPI\Controllers\ControllerHelper as Helper;
use UsDataAPI\Models\State;
use UsDataAPI\Validation\Validator;

class StateController
{
    //retrieve all states
    public function index(Request $request, Response $response, array $args)
    {
        //Get querystring variables from url
        $params = $request->getQueryParams();
        $term = array_key_exists('q', $params) ? $params['q'] : "";

        //Call the model method to get states
        $results = ($term) ? State::searchStates($term) : State::getStates();

        return Helper::withJson($response, $results, 200);
    }

    //view states by id
    public function view(Request $request, Response $response, array $args): Response
    {
        $id = $args['id'];
        $results = State::getStateById($id);
        return Helper::withJson($response, $results, 200);
    }

    //view cities by state
    public function viewCities(Request $request, Response $response, array $args):
    Response
    {
        $id = $args['id'];
        $results = State::getCitiesByState($id);
        return Helper::withJson($response, $results, 200);
    }


    //Create a state
    public function create(Request $request, Response $response, array $args) : Response {

        //Validate the request
        $validation = Validator::validateState($request);
        if(!$validation) {
            $results = [
                'status' => "Validation failed",
                'errors' => Validator::getErrors()
            ];
            return Helper::withJson($response, $results, 500);
        }


        //Create a new state
        $state = State::createState($request);
        if(!$state) {
            $results['status']= "State cannot be created.";
            return Helper::withJson($response, $results, 500);
        }
        $results = [
            'status' => "State has been created.",
            'data' => $state
        ];
        return Helper::withJson($response, $results, 200);
    }


    //Update a state
    public function update(Request $request, Response $response, array $args) : Response {
        //Validate the request
        $validation = Validator::validateState($request);
        //if validation failed
        if(!$validation) {
            $results = [
                'status' => "Validation failed",
                'errors' => Validator::getErrors()
            ];
            return Helper::withJson($response, $results, 500);
        }

        $state = State::updateState($request);
        if(!$state) {
            $results['status']= "State cannot be updated.";
            return Helper::withJson($response, $results, 500);
        }
        $results = [
            'status' => "State has been updated.",
            'data' => $state
        ];

        return Helper::withJson($response, $results, 200);
    }


    //Delete a state
    public function delete(Request $request, Response $response, array $args) : Response {
        $state = State::deleteState($request);

        if(!$state) {
            $results['status']= "State cannot be deleted.";
            return Helper::withJson($response, $results, 500);
        }

        $results['status'] = "State has been deleted.";
        return Helper::withJson($response, $results, 200);
    }


}
