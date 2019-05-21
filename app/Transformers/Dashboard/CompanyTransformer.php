<?php

namespace App\Transformers\Dashboard;

use App\Company;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;

/**
 * Company transformer.
 *
 * @package App\Transformers\Dashboard
 */
class CompanyTransformer implements TransformerContract
{
    use Collector;

	/**
	 * @param Request $request
	 * @return array
	 */
	public static function transformStoreRequest(Request $request)
	{
		return [
			'name' => $request->get('name'),
			'legal_name' => $request->get('legal_name'),
			'short_name' => $request->get('short_name'),
			'postcode' => $request->get('postcode'),
			'address' => $request->get('address'),
			'bid' => $request->get('bid'),
			'email' => $request->get('email'),
			'phone' => $request->get('phone'),
			'code' => $request->get('code'),
			'smtp_host' => $request->get('smtp_host'),
			'smtp_port' => $request->get('smtp_port'),
			'smtp_encryption' => $request->get('smtp_encryption'),
			'smtp_username' => $request->get('smtp_username'),
			'smtp_password' => $request->get('smtp_password'),
			'smtp_from' => $request->get('smtp_from'),
			'smtp_from_name' => $request->get('smtp_from_name'),
			'region' => (integer)$request->get('region'),

		];
	}

	/**
	 * @param Request $request
	 * @return array
	 */
	public static function transformUpdateRequest(Request $request)
	{
		return [
			'name' => $request->get('name'),
			'legal_name' => $request->get('legal_name'),
			'short_name' => $request->get('short_name'),
			'postcode' => $request->get('postcode'),
			'address' => $request->get('address'),
			'bid' => $request->get('bid'),
			'email' => $request->get('email'),
			'phone' => $request->get('phone'),
			'code' => $request->get('code'),
			'smtp_host' => $request->get('smtp_host'),
			'smtp_port' => $request->get('smtp_port'),
			'smtp_encryption' => $request->get('smtp_encryption'),
			'smtp_username' => $request->get('smtp_username'),
			'smtp_password' => $request->get('smtp_password'),
			'smtp_from' => $request->get('smtp_from'),
			'smtp_from_name' => $request->get('smtp_from_name'),
			'region' => (integer)$request->get('region'),

		];
	}

	/**
	 * @param Company $company
	 * @return array
	 */
	public static function toArray($company)
	{
		return [
			'id' => (int)$company->getKey(),
			'name' => $company->name,
			'legal_name' => $company->legal_name,
			'short_name' => $company->short_name,
			'postcode' => $company->postcode,
			'address' => $company->address,
			'bid' => $company->bid,
			'email' => $company->email,
			'phone' => $company->phone,
			'code' => $company->code,
			'smtp_host' => $company->smtp_host,
			'smtp_port' => $company->smtp_port,
			'smtp_encryption' => $company->smtp_encryption,
			'smtp_username' => $company->smtp_username,
			'smtp_password' => $company->smtp_password,
			'smtp_from' => $company->smtp_from,
			'smtp_from_name' => $company->smtp_from_name,
			'region' => $company->region ? RegionTransformer::toArray($company->region) : null,

			'created_at' => (string)$company->created_at,
			'updated_at' => (string)$company->updated_at,
			'deleted_at' => (string)$company->deleted_at,
		];
	}
}