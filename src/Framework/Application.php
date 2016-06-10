<?php

namespace Framework;

use Symfony\Component\HttpKernel\HttpKernelInterface;
use Symfony\Component\HttpFoundation\Request;

class Application {
    
    protected $kernel;

    public function __construct(HttpKernelInterface $kernel)
    {
        $this->kernel = $kernel;
    }
    
    public function run()
    {
        $request = Request::createFromGlobals();
        
        $response = $this->kernel->handle($request);
        $response->send();
    }

}