<?php

namespace App\Router;

use App\Config\Config;
use App\FS\FS;
use App\DI\Container;
use App\Http\Response;
use App\Router\Exception\ControllerDoesNotExistException;
use App\Router\Exception\MethodDoesNotExistException;
use App\Router\Exception\NotFoundException;
use App\Router\Exception\ExpectToRecieveResponseObjectException;

class Dispatcher {

    use RouteCollectionTrait;


    public function __construct(Container $di) {
        $this->di = $di;
        $this->config = $di->get(Config::class);
        $this->fs = $di->get(FS::class);
    }


    /**
     * @return Response
     * @throws ControllerDoesNotExistException
     * @throws MethodDoesNotExistException
     * @throws NotFoundException
     * @throws \ReflectionException
     */
    public function dispath() {
       
//        $request = $this->di->get(Request::class);
//        $url = $request->getUrl();

        /**
         * @var $route Route
         */
        $route = $this->di->get(\App\Router\Route::class);

        $controllerParams = [];
        foreach ($this->getRoutes() as $path => $controller) {
            if ($this->isValidPath($path, $route))
                    break;
        }


        $controllerClass = $route->getController();
    //   echo "<pre>"; var_dump($controllerClass); echo "</pre>"; exit;
        if (is_null($controllerClass)) {
            throw new NotFoundException();
        }

        if (!class_exists($controllerClass)) {
            throw new ControllerDoesNotExistException();
        }

        $controller = $this->di->get($controllerClass, [
            Route::class => $route
        ]);

        $controllerMethod = $route->getMethod();
 //       echo "<pre>"; var_dump($controllerMethod); echo "</pre>"; exit;
        if (!method_exists($controller, $controllerMethod)) {
            throw new MethodDoesNotExistException;
        }
        $response = $this->di->call($controller, $controllerMethod);
  //        echo "<pre>"; var_dump($controller, $controllerMethod); echo "</pre>"; exit;
        if (!($response instanceof Response)) {

            throw new ExpectToRecieveResponseObjectException();
        }

        return $response;
    }
    
    
    private function isValidPath(string $path, Route $route) {
        $routes = $this->getRoutes();
        $controller = $routes[$path];

        $isValidPath = $route->getUrl() == $path || $this->checkSmartPath($path, $route);


        if ($isValidPath) {
            $route->setController($controller[0]);
            $route->setMethod($controller[1]);           
        }
        return $isValidPath; 
    }

//    public function isValidPath(string $path) {
//        return $this->getUrl() == $path || $this->checkSmartPath($path);
//    }

    private function checkSmartPath (string $path, Route $route): bool {
        $isSmartPath = strpos($path, '{');

        if (!$isSmartPath) {
            return false;
        }

        $route->clearParams();
        $isEqual = false;

        $url = $route->getUrl();

        $urlChunks = explode('/', $url);
        $pathChunks = explode('/', $path);

        if (count($urlChunks) !== count($pathChunks)) {
            return false;
        }
//        $controllerParams = [];



        for ($i=0; $i < count($pathChunks); $i++) {
            $urlChunk = $urlChunks[$i];
            $pathChunk = $pathChunks[$i];
            $isSmartChunk = strpos($pathChunk, '{') !== false && strpos($pathChunk, '}') !== false;
            if ($urlChunk == $pathChunk) {
                $isEqual = true;

                continue;
            } else if ($isSmartChunk) {
                $paramName = str_replace(['{', '}'], '', $pathChunk);

                $route->setParam($paramName, $urlChunk);
// echo var_dump($route); exit;
//                $controllerParams[$paramName] = $urlChunk;
                $isEqual = true;

                continue;
            } else {
                $isEqual = false;
                break;
            }
        }
        return $isEqual;
    }


//    /**
//     *
//     * @return Container
//     */
//    public function getDi(): Container {
//        return $this->di;
//    }
}
