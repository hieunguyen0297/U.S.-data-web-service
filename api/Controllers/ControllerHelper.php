<?php
/**
 * Author: Hieu Nguyen
 * Date: 5/21/2022
 * File: ControllerHelper.php
 * Description: define controller helper class
 */

namespace UsDataAPI\Controllers;

use Psr\Http\Message\ResponseInterface as Response;

class ControllerHelper {

    // This method sends a response of data in JSON format along with a status code
    public static function withJson(Response $response, $data, int $code) : Response {
        $payload = json_encode($data);
        $response->getBody()->write($payload);
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($code);
    }
}