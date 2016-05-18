<?php

namespace Api\CustomerBundle\Controller;

use Api\CustomerBundle\App\Establishment\EstablishmentsPresenter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class EstablishmentsController extends Controller
{
    public function establishmentsAction()
    {
        $establishments = $this->getDoctrine()->getRepository('ApiCustomerBundle:Establishment')->findBy(['status' => 'approved']);
        if ($establishments !== []) {
            $presenter = new EstablishmentsPresenter($establishments);
            return new Response($presenter->present($establishments), Response::HTTP_OK);
        }
        $response = [
            'message' => "No establishments."
        ];
        return new Response(json_encode($response), Response::HTTP_NOT_FOUND);
    }
}
