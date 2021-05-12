<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
/**
 * Class UserController
 */
class UserController extends DefaultController
{
    const USER_REPO = 'AppBundle:User';

    /**
     * @Route("/register", name="user_register")
    */
    public function registerUser(Request $request)
    {
        return $this->render(
            "register.html.twig"
        );
    }

}
