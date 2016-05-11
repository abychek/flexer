<?php

namespace Api\CustomerBundle\Controller;

use Api\CustomerBundle\App\Card\Get\CardPresenter;
use Api\CustomerBundle\App\Card\Get\CardsPresenter;
use Api\CustomerBundle\Services\QrCodeService;
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
            'message' => "This user hasn't any cards"
        ];
        return new Response(json_encode($response), Response::HTTP_NOT_FOUND);
    }
    
    public function cardAction($customerId, $cardId)
    {
        $card = $this->getDoctrine()->getRepository('ApiCustomerBundle:Card')->findOneBy(
            [
                'customer' => $customerId, 
                'special' => $cardId
            ]
        );
        if ($card !== null) {
            $qrCodeService = new QrCodeService();
            $qrCode = $qrCodeService->qrcode([
                'customerId' => $customerId,
                'specialId' => $cardId,
                'count' => $card->getUsesCount()
            ]);
            $presenter = new CardPresenter();
            return new Response($presenter->present($card, $qrCode), Response::HTTP_OK);
        }
        $response = [
            'message' => "This user hasn't this card"
        ];
        return new Response(json_encode($response), Response::HTTP_NOT_FOUND);
    }
}
