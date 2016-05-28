<?php

namespace Api\EmployerBundle\App\Establishment;


use Api\EmployerBundle\Entity\Establishment;

class ConcreteEstablishmentPresenter
{
    public function present(Establishment $establishment)
    {
        $response = [
            'id' => $establishment->getId(),
            'title' => $establishment->getTitle(),
            'description' => $establishment->getDescription()
        ];
        return json_encode($response);
    }
}