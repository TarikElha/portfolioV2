<?php

// src/Middleware/CorsMiddleware.php

namespace App\Middleware;

use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpFoundation\Response;

class CorsMiddleware
{
    public function handle(RequestEvent $event)
    {
        $request = $event->getRequest();
        $response = $event->getResponse();

        if ($response instanceof Response) {
            // Ajouter les en-têtes CORS
            $response->headers->set('Access-Control-Allow-Origin', 'http://localhost:8000');
            $response->headers->set('Access-Control-Allow-Headers', 'Content-Type, Authorization');
            $response->headers->set('Access-Control-Allow-Methods', 'POST, PUT, GET, DELETE, OPTIONS');

            $event->setResponse($response);
        }
    }
}
