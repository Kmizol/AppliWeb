<?php
// config/routes.php
use App\Controller\AuthentificationController;
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$routes = new RouteCollection();
$routes->add('login', new Route('/login', array(
    '_controller' => array(AuthentificationController::class, 'login'),
)));

return $routes;
?>
