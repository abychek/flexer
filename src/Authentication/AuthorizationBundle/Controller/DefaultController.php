<?php

namespace Authentication\AuthorizationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function loginAction()
    {
        $message = [
            'success' => 'success'
        ];
        return new Response(json_encode($message), Response::HTTP_OK);
    }
}
