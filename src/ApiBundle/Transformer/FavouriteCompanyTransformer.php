<?php
namespace ApiBundle\Transformer;

use AppBundle\Entity\FavouriteCompany;
use League\Fractal\TransformerAbstract;

class FavouriteCompanyTransformer extends TransformerAbstract
{
    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
	public function transform(FavouriteCompany $favouriteCompany)
	{
        return [
            'id' => $favouriteCompany->getCompany()->getId(),
            'name' => $favouriteCompany->getCompany()->getName(),
            'address' => $favouriteCompany->getCompany()->getAddress(),
            'phone_number' => $favouriteCompany->getCompany()->getPhoneNumber()
        ];
    }
}