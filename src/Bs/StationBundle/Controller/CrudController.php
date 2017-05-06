<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 4/2/2017
 * Time: 10:45 PM
 */

namespace Bs\StationBundle\Controller;


use Bs\AppBundle\Controller\BaseController;
use Bs\CityBundle\Entity\Location;
use Bs\StationBundle\Entity\Station;
use Bs\StationBundle\Form\StationType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CrudController extends BaseController
{
    /**
     * @Route("/admin/add/station", name="add_station")
     * @param Request $request
     * @return RedirectResponse|Response
     */
    public function addAction(Request $request)
    {
        $station = new Station();
        $form = $this->createForm(StationType::class, $station);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $lat = $_POST['lat'];
            $lng = $_POST['lng'];
            $station->setLat($_POST['lat']);
            $station->setLng($_POST['lng']);

            $url = sprintf('http://maps.googleapis.com/maps/api/geocode/json?latlng=%f,%f&sensor=true',
                $lat,
                $lng);
            $data = $this->getAPI($url);
            $city = $data['results'][0]['address_components'][2]['long_name'];
            $region = $data['results'][0]['address_components'][1]['long_name'];
            $address = $data['results'][0]['formatted_address'];
            $station->setAddress($address);
            $em = $this->getDoctrine()->getManager();

            $location = $em->getRepository('BsCityBundle:Location')->findByCityAndRegion($city, $region);
            if (!$location) {
                $location = new Location();
                $location->setCity($city);
                $location->setRegion($region);
                $em->persist($location);
                $em->flush();
            }
            $station->setLocation($location);
            $em->persist($station);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                'Your user was successfully added.'
            );

            return $this->redirectToRoute('view_stations');
        }

        return $this->render(
            '@BsStation/add.html.twig',
            ['form' => $form->createView(),
                'station' => $station,
            ]
        );
    }

    /**
     * @param $url
     * @return mixed
     */
    public function getAPI($url)
    {
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($curl);
        curl_close($curl);
        $data = json_decode($result, true);
        return $data;
    }

    /**
     * @Route("/admin/delete/station/{id}/{filter}", name="delete_station")
     * @param Station $station
     * @param string $filter
     * @return RedirectResponse
     */
    public function removeStation(Station $station, $filter = null)
    {
        $lat = $_POST['lat'];
        $lng = $_POST['lng'];
        $station->setLat($_POST['lat']);
        $station->setLng($_POST['lng']);

        $url = sprintf('http://maps.googleapis.com/maps/api/geocode/json?latlng=%f,%f&sensor=true',
            $lat,
            $lng);
        $data = $this->getAPI($url);
        $city = $data['results'][0]['address_components'][2]['long_name'];
        $region = $data['results'][0]['address_components'][1]['long_name'];
        $address = $data['results'][0]['formatted_address'];
        $station->setAddress($address);
        $em = $this->getDoctrine()->getManager();

        $location = $em->getRepository('BsCityBundle:Location')->findByCityAndRegion($city, $region);
        if (!$location) {
            $location = new Location();
            $location->setCity($city);
            $location->setRegion($region);
            $em->persist($location);
            $em->flush();
        }
        $station->setLocation($location);
        $em->persist($station);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            'Your user was successfully added.'
        );
        $em = $this->getEntityManager();
        $em->remove($station);
        $em->flush();
        $this->get('session')->getFlashBag()->add(
            'success',
            'The Station was successfully deleted.'
        );

        return $this->redirectToRoute('view_stations', ['filter' => $filter]);
    }

    /**
     * @Route("/admin/edit/station/{id}/{filter}", name="edit_station")
     * @param Request $request
     * @param Station $station
     * @param null $filter
     * @return RedirectResponse|Response
     */
    public function editStationAction(Request $request, Station $station, $filter = null)
    {
        $form = $this->createForm(StationType::class, $station);

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $lat = $_POST['lat'];
            $lng = $_POST['lng'];
            $station->setLat($_POST['lat']);
            $station->setLng($_POST['lng']);

            $url = sprintf('http://maps.googleapis.com/maps/api/geocode/json?latlng=%f,%f&sensor=true',
                $lat,
                $lng);
            $data = $this->getAPI($url);
            $city = $data['results'][0]['address_components'][2]['long_name'];
            $region = $data['results'][0]['address_components'][1]['long_name'];
            $address = $data['results'][0]['formatted_address'];
            $station->setAddress($address);
            $em = $this->getDoctrine()->getManager();

            $location = $em->getRepository('BsCityBundle:Location')->findByCityAndRegion($city, $region);
            if (!$location) {
                $location = new Location();
                $location->setCity($city);
                $location->setRegion($region);
                $em->persist($location);
                $em->flush();
            }
            $station->setLocation($location);
            $em->persist($station);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                'Your user was successfully added.'
            );

            $em = $this->getDoctrine()->getManager();
            $em->persist($station);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                'success',
                'The station was succes ful updated.'
            );

            return $this->redirectToRoute('view_stations', ['filter' => $filter]);
        }

        return $this->render(
            '@BsStation/add.html.twig',
            array('form' => $form->createView(),
                'station'=> $station)
        );
    }
}