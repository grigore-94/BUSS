<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/22/2017
 * Time: 3:15 PM
 */

namespace Bs\AppBundle\Controller;


use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends BaseController
{
    /**
     * @Route("/autocomplete", name="search_route")
     * @param Request $request
     * @return JsonResponse
     */
    public function autocompleteAction(Request $request)
    {
        $names = array();
        $term = trim(strip_tags($request->get('term')));

        $em = $this->getEntityManager();

        $entities = $em->getRepository('BsCityBundle:Location')->findFilter($term);


        foreach ($entities as $entity) {
            $names[] = [
                'label' => $entity->getUniqueName(),
                'value' => $entity->getId(),
                       ];
        }
 /*       $response = new JsonResponse();
        $response->setData($names);*/
echo (json_encode($names));die;
    }
}