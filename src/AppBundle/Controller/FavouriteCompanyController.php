<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
/**
 * Class FavouriteCompanyController
 */
class FavouriteCompanyController extends Controller
{
    /**
     * @Route("/favouritecompany", name="favourite_company")
    */
    public function favourite_company()
    {
        return $this->render(
            "favourite_company.html.twig"
        );
    }

}
