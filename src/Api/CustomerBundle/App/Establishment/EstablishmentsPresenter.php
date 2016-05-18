<?php

namespace Api\CustomerBundle\App\Establishment;


use Api\CustomerBundle\Entity\Establishment;

class EstablishmentsPresenter
{
    /**
     * @param Establishment[] $establishments
     * @return string
     */
    public function present(array $establishments) {
        $response = [];

        foreach ($establishments as $establishment){
            $response[] = [
                'id' => $establishment->getId(),
                'title' => $establishment->getTitle(),
                'description' => $establishment->getDescription()
            ];
        }

        return json_encode($response);
    }
}