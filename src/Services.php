<?php

use bitExpert\Disco\Annotations\Bean;
use bitExpert\Disco\Annotations\Configuration;
use bitExpert\Disco\Annotations\Parameters;
use bitExpert\Disco\Annotations\Parameter;

/**
 * @Configuration
 */
class Services {

    /**
     * @Bean
     * @return \Symfony\Component\Routing\RequestContext 
     */
    public function context()
    {
        return new \Symfony\Component\Routing\RequestContext();
    }

    /**
     * @Bean
     *
     * @return \Symfony\Component\Routing\Matcher\UrlMatcher
     */
    public function matcher()
    {
        return new \Symfony\Component\Routing\Matcher\UrlMatcher($this->routeCollection(), $this->context());
    }

    /**
     * @Bean
     * @return \Symfony\Component\HttpFoundation\RequestStack
     */
    public function requestStack()
    {
        return new \Symfony\Component\HttpFoundation\RequestStack();
    }

    /**
     * @Bean
     * @return \Symfony\Component\Routing\RouteCollection
     */
    public function routeCollection()
    {
        return new \Symfony\Component\Routing\RouteCollection();
    }

    /**
     * @Bean
     * @return \Framework\RouteBuilder
     */
    public function routeBuilder()
    {
        return new \Framework\RouteBuilder($this->routeCollection());
    }

    /**
     * @Bean
     * @return \Symfony\Component\HttpKernel\Controller\ControllerResolver
     */
    public function resolver()
    {
        return new \Symfony\Component\HttpKernel\Controller\ControllerResolver();
    }

    /**
     * @Bean
     * @return \Framework\Application
     */
    public function application()
    {
        return new \Framework\Application($this->kernel());
    }

    /**
     * @Bean
     * @return \Symfony\Component\HttpKernel\EventListener\RouterListener
     */
    protected function listenerRouter()
    {
        return new \Symfony\Component\HttpKernel\EventListener\RouterListener(
            $this->matcher(),
            $this->requestStack()
        );
    }

    /**
     * @Bean
     * @return \Framework\StringResponseListener
     */
    protected function ListenerStringResponse()
    {
        return new \Framework\StringResponseListener();
    }

    /**
     * @Bean
     * @return \Symfony\Component\HttpKernel\EventListener\ExceptionListener
     */
    protected function listenerException()
    {
        return new \Symfony\Component\HttpKernel\EventListener\ExceptionListener('\Framework\\ExceptionManager::handle');
    }

    /**
     * @Bean
     * @return \Symfony\Component\EventDispatcher\EventDispatcher
     */
    public function dispatcher()
    {
        $dispatcher = new \Symfony\Component\EventDispatcher\EventDispatcher();

        $dispatcher->addSubscriber($this->listenerRouter());
        $dispatcher->addSubscriber($this->listenerException());
        $dispatcher->addSubscriber($this->ListenerStringResponse());

        return $dispatcher;
    }

    /**
     * @Bean
     * @return \Framework\Kernel
     */
    public function kernel()
    {
        return new \Framework\Kernel($this->dispatcher(), $this->resolver());
    }

}