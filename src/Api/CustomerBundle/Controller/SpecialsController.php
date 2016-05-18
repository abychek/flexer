<?php

namespace Api\CustomerBundle\Controller;

use Api\CustomerBundle\App\Special\ConcreteSpecialPresenter;
use Api\CustomerBundle\App\Special\SpecialsPresenter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class SpecialsController extends Controller
{
    public function specialsAction($id)
    {
        $special = $this->getDoctrine()->getRepository('ApiCustomerBundle:Special')->findBy(['establishment' => $id]);
        if ($special !== []) {
            $presenter = new SpecialsPresenter();
            return new Response($presenter->present($special), Response::HTTP_OK);
        }
        $response = [
            'message' => "No specials."
        ];
        return new Response(json_encode($response), Response::HTTP_NOT_FOUND);
    }

    public function specialAction($id)
    {
        $special = $this->getDoctrine()->getRepository('ApiCustomerBundle:Special')->findOneBy(['id' => $id]);
        if ($special !== []) {
            $presenter = new ConcreteSpecialPresenter();
            return new Response($presenter->present($special), Response::HTTP_OK);
        }
        $response = [
            'message' => "Special not found."
        ];
        return new Response(json_encode($response), Response::HTTP_NOT_FOUND);
    }
}
