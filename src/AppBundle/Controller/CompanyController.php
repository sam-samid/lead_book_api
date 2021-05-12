<?php

namespace AppBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Transformer\CompanyTransformer;
use League\Fractal\Resource\Collection;
use AppBundle\Entity\Company;
/**
 * Class CompanyController
 */
class CompanyController extends DefaultController
{
    const COMPANY_REPO = 'AppBundle:Company';

    /**
     * find Company
     * @Rest\Get("companies/{companyName}/find", name="api_find_company")
     * @param Request $request
     * @return View
     */
    public function findCompanyByName(Request $request, $companyName)
    {
        if(!$this->getAuthorization()){
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'please login to your account'
            ];
            return $this->generateResponseData($data);
        }
        
        $em = $this->getDoctrine()->getManager();
        
        $companies = $em->getRepository(self::COMPANY_REPO)->getCompanyByName($companyName);
        $collection = new Collection($companies, new CompanyTransformer);
        $companies = $this->manager->createData($collection)->toArray();
        
        if($companies){
            $data = [
                'code' => 200,
                'status' => 'success',
                'data' => $companies
            ];
        }else{
            $data = [
                'code' => 404,
                'status' => 'success',
                'message' => 'email verifying has been sent to your email'
            ];
        }   

        return $this->generateResponseData($data);
    }
}
