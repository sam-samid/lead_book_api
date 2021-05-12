<?php
namespace ApiBundle\Transformer;

use AppBundle\Entity\Company;
use League\Fractal\TransformerAbstract;

class CompanyTransformer extends TransformerAbstract
{
    /**
     * Turn this item object into a generic array
     *
     * @return array
     */
	public function transform(Company $company)
	{
        return [
            'id' => $company->getId(),
            'name' => $company->getName(),
            'address' => $company->getAddress(),
            'phone_number' => $company->getPhoneNumber()
        ];
    }
}