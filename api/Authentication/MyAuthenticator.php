<?php
/**
 * Author: Hieu Nguyen
 * Date: 6/4/2022
 * File: MyAuthenticator.php
 * Description: My Authenticator class
 */

namespace UsDataAPI\Authentication;

use Slim\Psr7\Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;
use UsDataAPI\Models\User;

class MyAuthenticator {
    public function __invoke(Request $request, RequestHandler $handler) : \Psr\Http\Message\ResponseInterface
    {
        //Username and password are stored in a header called "MyCollegeAPI-Authorization".
        if(!$request->hasHeader('UsDataAPI-Authorization')) {
            $results = ['Status' => 'UsDataAPI-Authorization header not found.'];
            return AuthenticationHelper::withJson($results, 401);
        }

        //Retrieve the header and then the username and password
        $auth = $request->getHeader('UsDataAPI-Authorization');
        list($username, $password) = explode(':', $auth[0]);

        //Validate the username and password
        if(!User::authenticateUser($username, $password)) {
            $results = ['Status' => 'Authentication failed.'];
            return AuthenticationHelper::withJson($results, 403);
        }

        //A user has been authenticated
        return $handler->handle($request);
    }
}