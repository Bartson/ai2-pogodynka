<?php

namespace App\Controller;

use App\Entity\Location;
use App\Repository\LocationRepository;
use App\Repository\MeasurementRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use App\Service\WeatherUtil;

class WeatherController extends AbstractController
{
    public function idAction(Location $location, MeasurementRepository $measurementRepository): Response
    {
        $measurements = $measurementRepository->findByLocation($location);

        return $this->render('weather/city.html.twig', [
            'location' => $location,
            'measurements' => $measurements,
        ]);
    }

    public function cityAction($city, WeatherUtil $weatherUtil): Response
    {
        return $this->render('weather/city.html.twig', $weatherUtil->getWeatherForCountryAndCity($city));
    }
}
