<?php

namespace Api\EmployerBundle\App\Worker;

use Api\EmployerBundle\Entity\Worker;

class WorkerPresenter
{
    /**
     * @param Worker $worker
     * @return string
     */
    public function present(Worker $worker)
    {
        $response = [
            'id' => $worker->getId(),
            'name' => $worker->getUser()->getName()
        ];
        return json_encode($response);
    }
}