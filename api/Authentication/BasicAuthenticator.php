<?php
/**
 * Author: Hieu Nguyen
 * Date: 6/4/2022
 * File: BasicAuthenticator.php
 * Description: Basic Authenticator class
 */

namespace UsDataAPI\Authentication;

use Slim\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use UsDataAPI\Models\User;

class BasicAuthenticator {
    public function __invoke(Request $request, RequestHandler $handler) : \Psr\Http\Message\ResponseInterface
    {
        // If the header named "Authorization" does not exist, display an error
        if (!$request->hasHeader('Authorization')) {
            $results = ['Status' => 'Authorization header not found.'];
            return AuthenticationHelper::withJson($results, 401);
        }

        // If the Authorization header exists, retrieve its value. The value is an array with one single value.
        $auth = $request->getHeader('Authorization')[0];
        list(, $apikey) = explode(" ", $auth, 2);
        list($user, $password) = explode(':', base64_decode($apikey));

        // Authenticate the user
        if(!User::authenticateUser($user, $password)) {
            $results = array('status' => 'Authentication failed');
            $response = AuthenticationHelper::withJson($results, 403);
            return $response->withHeader('WWW-Authenticate',  'Basic realm="UsDataAPI API"');
        }

        // Authentication succeeded
        return $handler->handle($request);
    }
}