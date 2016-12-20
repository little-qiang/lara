<?php
use Illuminate\Database\Capsule\Manager;
use Illuminate\Support\Fluent;

require	__DIR__.'/../vendor/autoload.php';

$app = new Illuminate\Container\Container;
Illuminate\Container\Container::setInstance($app);

with(new Illuminate\Events\EventServiceProvider($app))->register();
with(new Illuminate\Routing\RoutingServiceProvider($app))->register();

$manager = new Manager();
$manager->addConnection(require '../config/database.php');
$manager->bootEloquent();

$app->instance('config', new Fluent);
$app['config']['view.compiled'] = '/home/vagrant/Code/lara/storage/framework/views';
$app['config']['view.paths'] = ['/home/vagrant/Code/lara/resources/views'];

with(new Illuminate\View\ViewServiceProvider($app))->register();
with(new Illuminate\Filesystem\FilesystemServiceProvider($app))->register();

require __DIR__.'/../app/Http/routes.php';

$request = Illuminate\Http\Request::createFromGlobals();

$response = $app['router']->dispatch($request);

$response->send();