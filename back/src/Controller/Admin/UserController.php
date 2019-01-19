<?php

namespace App\Controller\Admin;

use App\Repository\UserRepository;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class UserController extends AbstractController
{
    /**
     * @Route("/admin/users", name="admin_users_index")
     * IsGranted("ROLE_ADMIN")
     */
    public function index(UserRepository $repo)
    {
        return $this->render('admin/user/index.html.twig', [
            'users' => $repo->findAll(),
        ]);
    }

    /**
     * @Route("/admin/users/visitors", name="admin_users_visitors")
     * IsGranted("ROLE_ADMIN")
     */
    public function visitor(UserRepository $repo)
    {
        return $this->render('admin/user/index.html.twig', [
            'users' => $repo->findByRole('ROLE_VISITOR'),
        ]);
    }

    /**
     * @Route("/admin/users/customers", name="admin_users_customers")
     * IsGranted("ROLE_ADMIN")
     */
    public function customer(UserRepository $repo)
    {
        return $this->render('admin/user/index.html.twig', [
            'users' => $repo->findByRole('ROLE_CUSTOMER'),
        ]);
    }
}
