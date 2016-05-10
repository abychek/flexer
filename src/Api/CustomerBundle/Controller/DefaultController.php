<?php

namespace Api\CustomerBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ApiCustomerBundle:Default:index.html.twig');
    }
}
