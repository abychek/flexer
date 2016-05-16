<?php

namespace Api\CustomerBundle\App\User\GetUser;

use Api\CustomerBundle\Entity\User;

class UserPresenter
{
    /**
     * @param User $user
     * 
     * @return string
     */
    public function present(User $user)
    {
        $response = [
            'id' => $user->getId(),
            'name' => $user->getName(),
            'username' => $user->getUsername(),
        ];
        return json_encode($response);
    }
}