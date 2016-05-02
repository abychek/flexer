<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthenticationController extends Controller
{
    public function registrationAction(Request $request)
    {
        try{
            $validator = $this->get('validator');

            $username = $request->get('username');
            if($this->getDoctrine()->getRepository('AppBundle:User')->findBy(['username' => $username]) == []){
                $user = new User();
                $user->setUsername($username)
                    ->setPassword($request->get('password'))
                    ->setName($request->get('name'))
                    ->setRoles(['ROLE_CUSTOMER']);

                $validationErrors = $validator->validate($user);

                if(count($validationErrors) > 0) {
                    return new Response((string)$validationErrors, Response::HTTP_BAD_REQUEST);
                }

                $em = $this->getDoctrine()->getEntityManager();
                $em->persist($user);
                $em->flush();
                return new Response('Success', Response::HTTP_OK);
            } else {
                throw new Exception();
            }
        } catch (Exception $ex){
            return new Response('Something wrong', Response::HTTP_BAD_REQUEST);
        }
    }
}