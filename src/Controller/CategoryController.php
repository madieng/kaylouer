<?php

namespace App\Controller;

use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category", name="category")
     */
    public function index()
    {
        return $this->render('category/index.html.twig', [
            'controller_name' => 'CategoryController',
        ]);
    }

    /**
     * @Route("/category/partials", name="category_partials")
     */
    public function partials(CategoryRepository $categoryRepository)
    {
        return $this->render('partials/category.html.twig', [
            'categories' => $categoryRepository->findAll()
        ]);
    }

}
