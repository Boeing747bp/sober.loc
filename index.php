<? error_reporting(E_ALL);

    require_once './core/config.php';

    $router = new Router();
    $router->setPath (PATH_CORE . 'src/Controllers');

    $router->start();