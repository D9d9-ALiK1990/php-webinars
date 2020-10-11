<?php

namespace App;

use App\Config\Config;
use App\Data\User\UserRepository;
use App\DI\Container;
use App\Middleware\IMiddleware;
use App\Renderer\Renderer;
use App\Router\Dispatcher;
use App\Router\Exception\ControllerDoesNotExistException;
use App\Router\ExpectToRecieveResponseObjectException;
use App\Router\Exception\MethodDoesNotExistException;
use App\Router\Exception\NotFoundException;
use Smarty;

class Kernel {

    /**
     * @var Container
     */
    private $di;

//    /**
//     *
//     * @var Container
//     */
//    private $container;
//
//    private $config;
    
    public function __construct() {


        $di = new Container();
        $this->di = $di;
        $di->addOneMapping(Container::class, $di);
        $di->singletone(Config::class, function() {
            $configDir = 'config';
            return Config::create($configDir);
        });

     //   echo "<pre>"; var_dump($di->singletone()); echo "</pre>";

        /**
         * @var $config Config
         */
        $config = $di->get(Config::class);

        $di->singletone(Smarty::class, function($di) {
            $smarty = new Smarty();
            $config = $di->get(Config::class);

            $smarty->template_dir = $config->renderer->templateDir;
            $smarty->compile_dir = $config->renderer->compileDir;

            return $smarty;
        });
        foreach ($config->di->singletones as $classname) {
            $di->singletone($classname);
        }
 //       echo "<pre>"; var_dump($config->di); echo "</pre>"; exit;
       // echo "<pre>"; var_dump($config->db->username, $config['db']); echo "</pre>";
    }
    
    public function run()
    {
        try {

            $config = $this->di->get(Config::class);
 //           echo "<pre>"; var_dump($config); echo"</pre>"; exit;
            foreach ($config->di->middlewares as $classname) {
                $middleware = $this->di->get($classname);
//echo "<pre>"; var_dump($middleware); echo"</pre>"; exit;
                if  ($middleware instanceof IMiddleware) {
                    $middleware->beforeDispatch();
                }
            }

            $response = (new Dispatcher($this->di))->dispath();

            foreach ($config->di->middlewares as $classname) {
                $middleware = $this->di->get($classname);
//echo "<pre>"; var_dump($middleware); echo"</pre>"; exit;
                if  ($middleware instanceof IMiddleware) {
                    $middleware->afterDispatch();
                }
            }


            echo $response;
        } catch (NotFoundException $e) {
            //404
            echo "404";
        } catch (ControllerDoesNotExistException | MethodDoesNotExistException $e) {
            //500
            echo "500 - controller / route";
        } catch (ExpectToRecieveResponseObjectException $e) {
            //500
            echo "500 - response";
        }catch (\ReflectionException $e) {
            //500
            echo "500 - reflection";
        }
    }
}
