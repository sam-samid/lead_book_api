<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
/**
 * Class UserController
 */
class UserController extends Controller
{
    /**
     * @Route("/registers", name="user_register")
    */
    public function registerUser()
    {
        return $this->render(
            "register.html.twig"
        );
    }

    /**
     * @Route("/login", name="user_login")
    */
    public function loginUser()
    {
        return $this->render(
            "login.html.twig"
        );
    }

    /**
     * @Route("/reset", name="reset_password")
    */
    public function resetPassword()
    {
        return $this->render(
            "reset_password.html.twig"
        );
    }

}
