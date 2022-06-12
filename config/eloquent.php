<?php
/**
 * Author: Hieu Nguyen
 * Date: 5/21/2022
 * File: eloquent.php
 * Description:
 */

use DI\Container;
use Illuminate\Database\Capsule\Manager;

return static function (Container $container) {
    // boot eloquent
    $capsule = new Manager;
    $capsule->addConnection($container->get('settings')['db']);
    $capsule->setAsGlobal();
    $capsule->bootEloquent();
};