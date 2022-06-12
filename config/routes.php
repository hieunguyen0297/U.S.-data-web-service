<?php
/**
 * Author: Hieu Nguyen
 * Date: 5/21/2022
 * File: routes.php
 * Description: file contains routing for different groups
 */

use Slim\App;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Routing\RouteCollectorProxy;
use UsDataAPI\Authentication\{MyAuthenticator, BasicAuthenticator,  BearerAuthenticator, JWTAuthenticator };

return function (App $app) {

    //Set up CORS (Cross-Origin Resource Sharing) https://www.slimframework.com/docs/v4/cookbook/enable-cors.html
    $app->options('/{routes:.+}', function ($request, $response, $args) {
        return $response;
    });

    $app->add(function ($request, $handler) {
        $response = $handler->handle($request);
        return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
    });


//    // Create app routes
//    // Define app route
    $app->get('/api/v1', function (Request $request, Response $response, array $args) {
        $response->getBody()->write('Welcome to U.S data API!');
        return $response;
    });


    // User route group
    $app->group('/api/v1/users', function (RouteCollectorProxy $group) {
        $group->get('', 'User:index');
        $group->post('', 'User:create');
        $group->post('/authBearer', 'User:authBearer');
        $group->post('/authJWT', 'User:authJWT');
        $group->put('/{id}', 'User:update');
        $group->delete('/{id}', 'User:delete');
        $group->get('/{id}', 'User:view');
    });

    //Route group for api/v1 pattern
    $app->group('/api/v1', function (RouteCollectorProxy $group) {
        //Route group for states pattern
        $group->group('/states', function (RouteCollectorProxy $group) {
            //Call the index method defined in the StateController class
            //State is the container key defined in dependencies.php.
            $group->get('', 'State:index');
            $group->get('/{id}', 'State:view');
            $group->get('/{id}/cities', 'State:viewCities');
            $group->post('', 'State:create');
            $group->put('/{id}', 'State:update');
            $group->delete('/{id}', 'State:delete');
        });

        //region group
        $group->group('/regions', function (RouteCollectorProxy $group) {
            $group->get('', 'Region:index');
            $group->get('/{id}', 'Region:view');
            $group->get('/{id}/states', 'Region:viewStates');
        });

        //election group
        $group->group('/elections', function (RouteCollectorProxy $group) {
            $group->get('', 'Election:index');
            $group->get('/{id}', 'Election:view');
            $group->get('/{id}/states', 'Election:viewStates');
        });

        //rating group
        $group->group('/ratings', function (RouteCollectorProxy $group) {
            $group->get('', 'Rating:index');
            $group->get('/{id}', 'Rating:view');
            $group->get('/{id}/cities', 'Rating:viewCities');
        });

        //cities group
        $group->group('/cities', function (RouteCollectorProxy $group) {
            $group->get('', 'City:index');
            $group->get('/{id}', 'City:view');
        });
//    })->add(new MyAuthenticator());
//    })->add(new BasicAuthenticator());
//    })->add(new BearerAuthenticator());
    }) ->add(new JWTAuthenticator());
//    ->add(new JWTAuthenticator());

};