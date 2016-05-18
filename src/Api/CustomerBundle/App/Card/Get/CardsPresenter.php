<?php

namespace Api\CustomerBundle\App\Card\Get;


use Api\CustomerBundle\Entity\Card;

class CardsPresenter
{
    /**
     * @param Card[] $cards
     * @return string
     */
    public function present(array $cards)
    {
        $response = [];
        foreach ($cards as $card) {
            $response[] = [
                'id' => $card->getId(),
                'title' => $card->getSpecial()->getTitle(),
                'description' => $card->getSpecial()->getDescription(),
                'establishment' => [
                    'title' => $card->getSpecial()->getEstablishment()->getTitle()
                ]
            ];
        }
        return json_encode($response);
    }
}