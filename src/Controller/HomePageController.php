<?php

namespace App\Controller;

use App\Repository\MakeRepository;
use App\Repository\CarRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(MakeRepository $makeRepository, CarRepository $carRepository)
    {
        return $this->render('home_page/index.html.twig', [
            'makes' => $makeRepository->findAll(),
            'cars' => $carRepository->findBy([], null, 20)
        ]);
    }
}
