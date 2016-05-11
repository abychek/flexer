<?php

namespace Api\CustomerBundle\Controller;

use Api\CustomerBundle\App\Card\Get\CardsPresenter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class CardsController extends Controller
{
    public function cardsAction($id)
    {
        $cards = $this->getDoctrine()->getRepository('ApiCustomerBundle:Card')->findBy(['customer' => $id]);
        if ($cards !== []) {
            $presenter = new CardsPresenter();
            return new Response($presenter->present($cards), Response::HTTP_OK);
        }
        $response = [
            'message' => "Don't have any cards"
        ];
        return new Response(json_encode($response), Response::HTTP_NOT_FOUND);
    }
}
