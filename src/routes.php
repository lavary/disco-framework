<?php

$routes = $container->get('routeBuilder')
    
->get('home', '/', function() {
            return 'It works!';
})

->get('welcome', '/welcome', function() {
            return 'Welcome!';
});

       