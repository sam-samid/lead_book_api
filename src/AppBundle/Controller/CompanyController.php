<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
/**
 * Class CompanyController
 */
class CompanyController extends Controller
{
    /**
     * @Route("/company", name="company")
    */
    public function searchCompany()
    {
        return $this->render(
            "company.html.twig"
        );
    }

}
