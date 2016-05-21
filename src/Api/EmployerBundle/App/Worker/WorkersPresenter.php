<?php

namespace Api\EmployerBundle\App\Worker;

use Api\EmployerBundle\Entity\Worker;

class WorkersPresenter
{
    /**
     * @param Worker[] $workers
     * @return string
     */
    public function present(array $workers)
    {
        $response = [];
        foreach ($workers as $worker) {
            $response[] = [
                'id' => $worker->getId(),
                'name' => $worker->getUser()->getName(),
            ];
        }
        return json_encode($response);
    }
}