<?php
/**
 * Author: Hieu Nguyen
 * Date: 6/4/2022
 * File: JWTAuthenticator.php
 * Description: JWT authenticator
 *
 */

namespace UsDataAPI\Authentication;

use Slim\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use UsDataAPI\Models\User;

class JWTAuthenticator {
    public function __invoke(Request $request, RequestHandler $handler) : \Psr\Http\Message\ResponseInterface
    {
        //If the header named "Authorization" does not exist, returns an error
        if(!$request->hasHeader('Authorization')) {
            $results = ['Status' => 'Authorization header not available'];
            return AuthenticationHelper::withJson($results, 401);
        }

        //Retrieve the header and the token
        $auth = $request->getHeader('Authorization');
        list(, $token) = explode(" ", $auth[0], 2);

        //Validate the token
        if(!User::validateJWT($token)) {
            $results = ['Status' => 'Authentication failed.'];
            return AuthenticationHelper::withJson($results, 403);
        }

        //Authentication succeeded
        return $handler->handle($request);
    }
}