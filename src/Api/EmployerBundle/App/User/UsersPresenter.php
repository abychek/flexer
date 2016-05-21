<?php

namespace Api\EmployerBundle\App\User;


use Api\EmployerBundle\Entity\User;

class UsersPresenter
{
    /**
     * @param User[] $users
     *
     * @return string
     */
    public function present(array $users)
    {

        $response = [];
        foreach ($users as $user) {
            $response[] = [
                'id'       => $user->getId(),
                'name'     => $user->getName(),
                'username' => $user->getUsername()
            ];
        }
        return json_encode($response);
    }
}