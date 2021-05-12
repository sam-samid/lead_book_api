<?php

namespace ApiBundle\Controller;

use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\Request;
use ApiBundle\Transformer\FavouriteCompanyTransformer;
use League\Fractal\Resource\Collection;
use AppBundle\Entity\FavouriteCompany;
/**
 * Class CompanyController
 */
class FavouriteCompanyController extends DefaultController
{
    const USER_REPO = 'AppBundle:User';
    const COMPANY_REPO = 'AppBundle:Company';
    const FAVOURITE_COMPANY_REPO = 'AppBundle:FavouriteCompany';

    /**
     * find Favourite Company by user id
     * @Rest\Get("favouritecompanies/{userId}/find", name="api_find_favourite_company")
     * @param Request $request
     * @return View
     */
    public function findfavoriteCompanyUserId(Request $request, $userId)
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
        
        $companies = $em->getRepository(self::FAVOURITE_COMPANY_REPO)->findBy(['userId'=>$userId, 'deletedAt'=>NULL]);
        $collection = new Collection($companies, new FavouriteCompanyTransformer);
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
                'status' => 'error',
                'message' => 'not found'
            ];
        }   

        return $this->generateResponseData($data);
    }

    /**
     * mark Company as favourite
     * @Rest\Post("/favouritecompanies/{userId}/users/{companyId}/companies/favourite", name="api_set_favourite_company")
     * @param Request $request
     * @return View
     */
    public function setCompanyAsFavourite(Request $request, $userId, $companyId)
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

        $user = $em->getRepository(self::USER_REPO)->find($userId);
        $company = $em->getRepository(self::COMPANY_REPO)->find($companyId);

        $favouriteCompany = $em->getRepository(self::FAVOURITE_COMPANY_REPO)->findOneBy(['userId'=>$userId, 'companyId'=>$companyId, 'deletedAt'=>Null]);
        if ($favouriteCompany) {
            $data = [
                'code' => 400,
                'status' => 'error',
                'message' => 'already add as favourite'
            ];
        }else{
            $favouriteCompany = new FavouriteCompany();
            $favouriteCompany->setUser($user);
            $favouriteCompany->setCompany($company);
            $favouriteCompany->setCreatedAt(new \DateTime());
            $em->persist($favouriteCompany);
            $em->flush();
    
            $data = [
                'code' => 200,
                'status' => 'success',
                'message' => 'company has added to favourite table'
            ];
        }


        return $this->generateResponseData($data);
    }

    /**
     * mark Company as unfavourite
     * @Rest\Post("/favouritecompanies/{id}/unfavourite", name="api_unset_favourite_company")
     * @param Request $request
     * @return View
     */
    public function setCompanyAsUnfavourite(Request $request, $id)
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

        $favouriteCompany = $em->getRepository(self::FAVOURITE_COMPANY_REPO)->find($id);
        
        $favouriteCompany->setDeletedAt(new \DateTime());
        $em->persist($favouriteCompany);
        $em->flush();

        $data = [
            'code' => 200,
            'status' => 'success',
            'message' => 'company has removed from favourite table'
        ];

        return $this->generateResponseData($data);
    }

}
