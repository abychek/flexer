<?php

namespace Api\CustomerBundle\Controller;

use Api\CustomerBundle\App\User\GetUser\UserPresenter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
    public function userAction($id)
    {
        $repository = $this->getDoctrine()->getRepository('ApiCustomerBundle:User');
        $user = $repository->findOneBy(['id' => $id]);
        if ($user !== null) {
            $presenter = new UserPresenter();
            return new Response($presenter->present($user), Response::HTTP_OK);
        }
        $response = [
            'message' => 'User not found'
        ];
        return new Response(json_encode($response), Response::HTTP_NOT_FOUND);
    }
}
