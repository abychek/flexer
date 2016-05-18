<?php

namespace Api\CustomerBundle\Controller;

use Api\CustomerBundle\App\Card\Get\CardPresenter;
use Api\CustomerBundle\App\Card\Get\CardsPresenter;
use Api\CustomerBundle\Entity\Card;
use Api\CustomerBundle\Services\QrCodeService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
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
                'id' => $cardId
            ]
        );
        if ($card !== null) {
            $qrCodeService = new QrCodeService();
            $qrCode = $qrCodeService->qrcode([
                'userId' => $customerId,
                'cardId' => $cardId,
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

    public function registerNewCardAction(Request $request)
    {
        $special = $this->getDoctrine()->getRepository('ApiCustomerBundle:Special')->findOneBy(
            [
                'id' => $request->get('id')
            ]
        );
        $customer = $this->getDoctrine()->getRepository('ApiCustomerBundle:User')->findOneBy(
            [
                'id' => $this->getUser()->getId()
            ]
        );
        if($special !== null){
            $card = $this->getDoctrine()->getRepository('ApiCustomerBundle:Card')->findOneBy(
                [
                    'customer' => $customer,
                    'special' => $special
                ]
            );
            if ($card == null){
                $card = new Card();
                $card->setCustomer($customer);
                $card->setSpecial($special);
                $card->setUsesCount(0);

                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($card);
                $em->flush();

                $response = [
                    'message' => 'success'
                ];
                return new Response(json_encode($response), Response::HTTP_OK);
            }
            $response = [
                'message' => 'You already have card.'
            ];
            return new Response(json_encode($response), Response::HTTP_FOUND);
        }
        $response = [
            'message' => 'Not found this special.'
        ];
        return new Response(json_encode($response), Response::HTTP_NOT_FOUND);
    }
}
