<?php

namespace Framework;

class Factory {
    
    /**
     * Create an instance of Disco container
     *
     * @param  array $parameters
     * @return \bitExpert\Disco\AnnotationBeanFactory
     */
    public static function buildContainer($parameters = [])
    {
        $container = new \bitExpert\Disco\AnnotationBeanFactory(\Services::class, $parameters);
        \bitExpert\Disco\BeanFactoryRegistry::register($container);

        return $container;
    }

}