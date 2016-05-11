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
                'needed_count' => $card->getSpecial()->getCount(),
                'used_count' => $card->getUsesCount()
            ];
        }
        return json_encode($response);
    }
}