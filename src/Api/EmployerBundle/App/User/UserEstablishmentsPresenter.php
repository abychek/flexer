<?php

namespace Api\EmployerBundle\App\User;

use Api\EmployerBundle\Entity\Establishment;

class UserEstablishmentsPresenter
{
    /**
     * @param Establishment[] $establishments
     *
     * @return string
     */
    public function present(array $establishments)
    {
        $response = [];
        foreach ($establishments as $establishment) {
            $response[] = [
                'id'    => $establishment->getId(),
                'title' => $establishment->getTitle()
            ];
        }
        return json_encode($response);
    }
}