<?php

namespace Api\EmployerBundle\Controller;

use Api\EmployerBundle\App\Establishment\ConcreteEstablishmentPresenter;
use Api\EmployerBundle\Entity\Establishment;
use Api\EmployerBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class EstablishmentsController extends Controller
{
    public function concreteEstablishmentAction($id)
    {
        $establishment = $this->getDoctrine()->getRepository('ApiEmployerBundle:Establishment')->findOneBy([
            'id' => $id
        ]);
        if ($establishment !== null) {
            $presenter = new ConcreteEstablishmentPresenter();
            return new Response($presenter->present($establishment), Response::HTTP_OK);
        }
        $response = [
            'message' => 'Not found this establishment.'
        ];
        return new Response(json_encode($response), Response::HTTP_NOT_FOUND);
    }

    public function registerEstablishmentAction(Request $request)
    {
        $validator = $this->get('validator');
        $owner = $this->getDoctrine()->getRepository('ApiEmployerBundle:User')->findOneBy(
            [
                'id' => $this->getUser()->getId()
            ]
        );
        $establishment = new Establishment();
        $establishment->setTitle($request->get('title'));
        $establishment->setDescription($request->get('description'));
        $establishment->setOwner($owner);
        $establishment->setStatus('approved');
        $validationErrors = $validator->validate($establishment);
        if (count($validationErrors) > 0) {
            return new Response((string)$validationErrors, Response::HTTP_BAD_REQUEST);
        }
        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($establishment);
        $em->flush();
        
        return new Response(json_encode(['message' => 'success']), Response::HTTP_OK);
    }
}
