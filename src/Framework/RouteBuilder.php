<?php

namespace Framework;

use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

class RouteBuilder {
    
    protected $routes;

    public function __construct(RouteCollection $routes)
    {
        $this->routes = $routes;
    }

    /**
     * Description
     * 
     * @param  string  $name
     * @param  string  $path
     * @param  mixed   $controller
     *
     * @return $this
     */
    public function get($name, $path, $controller)
    {
        return $this->add($name, $path, $controller, 'GET');
    }

    /**
     * Description
     * 
     * @param  string  $name
     * @param  string  $path
     * @param  Closure $controller
     *
     * @return $this
     */
    public function post($name, $path, $controller)
    {
        return $this->add($name, $path, $controller, 'POST');
    }

    /**
     * Description
     * 
     * @param  string  $name
     * @param  string  $path
     * @param  Closure $controller
     *
     * @return $this
     */
    public function put($name, $path, $controller)
    {
        return $this->add($name, $path, $controller, 'PUT');
    }

    /**
     * Description
     * 
     * @param  string  $name
     * @param  string  $path
     * @param  Closure $controller
     *
     * @return $this
     */
    public function delete($name, $path, $controller)
    {
        return $this->add($name, $path, $controller, 'DELETE');
    }

    /**
     * Description
     * 
     * @param  string  $name
     * @param  string  $path
     * @param  Closure $controller
     * @param  string  $method
     *
     * @return void
     */
    public function add($name, $path, $controller, $method)
    {
        $this->routes->add($name, new Route($path, ['_controller' => $controller], ['_method' => $method]));

        return $this;
    }

}