<?php

$router = $di->getRouter();

$router->addGet(
        '/generate/generate/([0-9]{1})',
        [
            'controller' => 'generate',
            'action'     => 'generate',
            'step'       => 1
        ]);

$router->handle();
