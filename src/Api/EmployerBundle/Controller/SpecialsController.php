<?php

namespace Api\EmployerBundle\Controller;

use Api\EmployerBundle\Entity\Special;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SpecialsController extends Controller
{
    public function registerSpecialAction(Request $request, $id)
    {
        $establishment = $this->getDoctrine()->getRepository('ApiEmployerBundle:Establishment')->findOneBy(
            [
                'id' => $id
            ]
        );

        $validator = $this->get('validator');

        $special = new Special();
        $special->setTitle($request->get('title'));
        $special->setDescription($request->get('description'));
        $special->setCount($request->get('count'));
        $special->setStartDate(new \DateTime($request->get('start_date')));
        $special->setEndDate(new \DateTime($request->get('end_date')));
        $special->setStatus('approved');
        $special->setType('quest');
        $special->setEstablishment($establishment);

        if (count($validationErrors = $validator->validate($special)) > 0) {
            return new Response((string)$validationErrors, Response::HTTP_BAD_REQUEST);
        }
        $em = $this->getDoctrine()->getEntityManager();
        $em->persist($special);
        $em->flush();

        return new Response(json_encode(['message' => 'success']), Response::HTTP_OK);
    }
}
