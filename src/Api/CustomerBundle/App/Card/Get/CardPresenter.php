<?php

namespace Api\CustomerBundle\App\Card\Get;

use Api\CustomerBundle\Entity\Card;

class CardPresenter
{
    public function present(Card $card, $qrCode)
    {
        $response = [
            'id'           => $card->getId(),
            'title'        => $card->getSpecial()->getTitle(),
            'description'  => $card->getSpecial()->getDescription(),
            'needed_count' => $card->getSpecial()->getCount(),
            'actual_count' => $card->getUsesCount(),
            'qr_code'      => $qrCode
        ];
        return json_encode($response);
    }
}