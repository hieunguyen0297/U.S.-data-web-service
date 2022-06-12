<?php
/**
 * Author: Hieu Nguyen
 * Date: 5/21/2022
 * File: dependencies.php
 * Description: adding dependencies for the application
 */

use DI\Container;
use UsDataAPI\Controllers\CityController;
use UsDataAPI\Controllers\ElectionController;
use UsDataAPI\Controllers\RatingController;
use UsDataAPI\Controllers\RegionController;
use UsDataAPI\Controllers\StateController;
use UsDataAPI\Controllers\UserController;

return function (Container $container) {
    $container->set('State', function () {
        return new StateController();
    });

    $container->set('Region', function () {
        return new RegionController();
    });

    $container->set('Election', function () {
        return new ElectionController();
    });

    $container->set('Rating', function () {
        return new RatingController();
    });

    $container->set('City', function () {
        return new CityController();
    });


    $container->set('User', function () {
        return new UserController();
    });
};