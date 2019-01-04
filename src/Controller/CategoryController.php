<?php

namespace App\Controller;

use App\Entity\Category;
use App\Repository\CategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends AbstractController
{
    /**
     * @Route("/category/{slug}", name="category_show")
     */
    public function index(Category $category)
    {
        return $this->render('category/index.html.twig', [
            'category' => $category,
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
