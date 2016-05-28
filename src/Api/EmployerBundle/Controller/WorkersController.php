<?php

namespace Api\EmployerBundle\Controller;

use Api\EmployerBundle\App\Worker\WorkerPresenter;
use Api\EmployerBundle\App\Worker\WorkersPresenter;
use Api\EmployerBundle\Entity\Worker;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class WorkersController extends Controller
{
    public function workersAction($id)
    {
        $workers = $this->getDoctrine()->getRepository('ApiEmployerBundle:Worker')->findBy([
            'establishment' => $id,
            'status' => 'worked'
        ]);
        if ($workers !== []) {
            $presenter = new WorkersPresenter();
            return new Response($presenter->present($workers), Response::HTTP_OK);
        }
        $response = [
            'message' => 'Not found workers for this establishment.'
        ];
        return new Response(json_encode($response), Response::HTTP_NOT_FOUND);
    }

    public function workerAction($establishmentId, $workerId)
    {
        $worker = $this->getDoctrine()->getRepository('ApiEmployerBundle:Worker')->findOneBy([
            'id' => $workerId,
            'establishment' => $establishmentId
        ]);
        if ($worker !== null) {
            $presenter = new WorkerPresenter();
            return new Response($presenter->present($worker), Response::HTTP_OK);
        }
        $response = [
            'message' => 'Not found worker for this establishment.'
        ];
        return new Response(json_encode($response), Response::HTTP_NOT_FOUND);
    }

    public function changeAction($establishmentId, $workerId, Request $request)
    {
        $worker = $this->getDoctrine()->getRepository('ApiEmployerBundle:Worker')->findOneBy([
            'id' => $workerId,
            'establishment' => $establishmentId,
        ]);
        if ($worker !== null) {
            $worker->setStatus($request->get('status'));
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($worker);
            $em->flush();
            $response = [
                'message' => 'Success'
            ];
            return new Response(json_encode($response), Response::HTTP_OK);
        }
        $response = [
            'message' => 'Not found worker for this establishment.'
        ];
        return new Response(json_encode($response), Response::HTTP_NOT_FOUND);
    }

    public function hireAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getEntityManager();
        $establishment = $this->getDoctrine()->getRepository('ApiEmployerBundle:Establishment')->findOneBy([
            'id' => $id
        ]);
        $user = $this->getDoctrine()->getRepository('ApiEmployerBundle:User')->findOneBy([
            'id' => $request->get('userId')
        ]);

        if ($establishment !== null && $user !== null) {
            $worker = $this->getDoctrine()->getRepository('ApiEmployerBundle:Worker')->findOneBy([
                'user'          => $user->getId(),
                'establishment' => $establishment->getId()
            ]);
            if ($worker !== null && $worker->getStatus() !== 'worked') {
                $worker->setStatus('worked');
            } elseif ($worker === null) {
                $worker = new Worker();
                $worker->setUser($user);
                $worker->setEstablishment($establishment);
                $worker->setStatus('worked');
                $user->addRole('ROLE_EMPLOYEE');
                $em->persist($user);
                $em->flush();
            } else {
                return new Response(json_encode(['message' => 'Already work.'], Response::HTTP_FOUND));
            }
            $em->persist($worker);
            $em->flush();
            return new Response(json_encode(['message' => 'success'], Response::HTTP_OK));
        } elseif($establishment === null) {
            return new Response(json_encode(['message' => 'Not found establishment'], Response::HTTP_NOT_FOUND));
        } else {
            return new Response(json_encode(['message' => 'User not found'], Response::HTTP_BAD_REQUEST));
        }
    }
}
