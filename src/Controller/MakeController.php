<?php

namespace App\Controller;

use App\Entity\Make;
use App\Repository\MakeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class MakeController extends AbstractController
{
    /**
     * @Route("/make/{slug}", name="make_show")
     */
    public function index(Make $make)
    {
        return $this->render('make/index.html.twig', [
            'make' => $make,
        ]);
    }

    /**
     * @Route("/make/partials", name="make_partials")
     */
    public function partials(MakeRepository $makeRepository)
    {
        return $this->render('partials/make.html.twig', [
            'makes' => $makeRepository->findAll()
        ]);
    }

}
