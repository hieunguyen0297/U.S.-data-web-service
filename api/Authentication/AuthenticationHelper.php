<?php
/**
 * Author: Hieu Nguyen
 * Date: 6/4/2022
 * File: AuthenticationHelper.php
 * Description: Authentication Helper class
 */
namespace UsDataAPI\Authentication;

use Slim\Psr7\Response;

class AuthenticationHelper {
    public static function withJson($data, int $code) : Response {
        $response = new Response();
        $response->getBody()->write(json_encode($data));
        return $response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($code);
    }
}
