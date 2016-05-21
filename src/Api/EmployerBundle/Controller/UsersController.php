<?php

namespace Api\EmployerBundle\Controller;

use Api\EmployerBundle\App\User\UserEstablishmentsPresenter;
use Api\EmployerBundle\App\User\UsersPresenter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
    public function usersAction(Request $request)
    {
        $users = $this->getDoctrine()
            ->getRepository('ApiEmployerBundle:User')
            ->findByNotEstablishmentId($request->get('establishment'));
        if ($users !== []) {
            $presenter = new UsersPresenter();
            return new Response($presenter->present($users), Response::HTTP_OK);
        }
        $response = [
            'message' => 'Not found users.'
        ];
        return new Response(json_encode($response), Response::HTTP_NOT_FOUND);
    }

    public function userEstablishmentsAction($id)
    {
        $establishments = $this->getDoctrine()->getRepository('ApiEmployerBundle:Establishment')->findBy([
            'owner' => $id
        ]);
        if ($establishments !== []) {
            $presenter = new UserEstablishmentsPresenter();
            return new Response($presenter->present($establishments), Response::HTTP_OK);
        }
        $response = [
            'message' => 'Not found any establishment for this user.'
        ];
        return new Response(json_encode($response), Response::HTTP_NOT_FOUND);
    }
}
