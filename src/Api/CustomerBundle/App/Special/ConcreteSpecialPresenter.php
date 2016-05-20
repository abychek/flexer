<?php

namespace Api\CustomerBundle\App\Special;


use Api\CustomerBundle\Entity\Special;

class ConcreteSpecialPresenter
{
    public function present(Special $special)
    {
        $response = [
            'id' => $special->getId(),
            'title' => $special->getTitle(),
            'description' => $special->getDescription(),
            'start_date' => $special->getStartDate()->format('d.m.Y'),
            'end_date' => $special->getEndDate()->format('d.m.Y'),
            'count' => $special->getCount()
        ];
        return json_encode($response);
    }
}