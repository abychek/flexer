<?php

namespace Api\EmployeeBundle\Controller;

use Exception;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller
{
    public function changeCardAction(Request $request, $id)
    {
        try{
            $card = $this->getDoctrine()->getRepository('ApiEmployeeBundle:Card')->findOneBy(['id' => $id]);
            if ($card !== null){

                $id = $this->getUser()->getId();
                if (!$this->isWorker($id, $card->getSpecial()->getEstablishment()->getId()))
                {
                    throw new Exception();
                }

                $needed = $card->getSpecial()->getCount();
                $actual = $request->get('count');
                if ($needed < $actual ) {
                    return new Response('Get bonus.', Response::HTTP_BAD_REQUEST);
                }
                $card->setUsesCount($request->get('count'));

                $actual = $card->getUsesCount();

                $response = [
                    'needed' => $needed,
                    'actual' => $actual
                ];
                return new Response(json_encode($response), Response::HTTP_OK);
            } else {
                throw new Exception();
            }
        } catch (Exception $e) {
            return new Response('Something wrong.', Response::HTTP_NOT_FOUND);
        }
    }

    /**
     * @param int $workerId
     * @param int $establishmentId
     *
     * @return bool
     */
    private function isWorker($workerId, $establishmentId)
    {
        return $this->getDoctrine()->getRepository('ApiEmployeeBundle:Worker')->findOneBy([
            'user' => $workerId,
            'establishment' => $establishmentId
        ]) !== null;
    }
}
