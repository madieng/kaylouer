<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class HomePageController extends AbstractController
{
    /**
     * @Route("/", name="homepage")
     */
    public function index(CategoryRepository $categoryRepository, ProductRepository $productRepository)
    {
        return $this->render('home_page/index.html.twig', [
            'categories' => $categoryRepository->findAll(),
            'products' => $productRepository->findBy([], null, 3)
        ]);
    }
}
