<?php

namespace App\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;

class HomePageController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     *  @IsGranted("ROLE_USER")
     */
    public function index()
    {
        return $this->render('home_page/index.html.twig', []);
    }
}
