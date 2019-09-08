<?php

namespace App\Transformers\Dashboard;

use App\CompanyBankAccount;
use Crmplease\MaterialAdmin\Http\Requests\Request;
use Crmplease\MaterialAdmin\Transformers\Contracts\TransformerContract;
use Crmplease\MaterialAdmin\Transformers\Traits\Collector;
use Illuminate\Support\Collection;

/**
 * CompanyBankAccount transformer.
 *
 * @package App\Transformers\Dashboard
 */
class CompanyBankAccountTransformer implements TransformerContract
{
    use Collector;

    /**
     * @param Request $request
     * @return array
     */
    public static function transformStoreRequest(Request $request)
    {
        return [
            'bank' => $request->get('bank'),
            'swift' => $request->get('swift'),
            'account' => $request->get('account'),
            'iban' => $request->get('iban'),
            'default' => (boolean)$request->get('default'),
            'company' => (integer)$request->get('company'),

        ];
    }

    /**
     * @param Request $request
     * @return array
     */
    public static function transformUpdateRequest(Request $request)
    {
        return [
            'bank' => $request->get('bank'),
            'swift' => $request->get('swift'),
            'account' => $request->get('account'),
            'iban' => $request->get('iban'),
            'default' => (boolean)$request->get('default'),
            'company' => (integer)$request->get('company'),

        ];
    }

    /**
     * @param CompanyBankAccount $companyBankAccount
     * @return array
     */
    public static function toArray($companyBankAccount)
    {
        return [
            'id' => (int)$companyBankAccount->getKey(),
            'bank' => $companyBankAccount->bank,
            'swift' => $companyBankAccount->swift,
            'account' => $companyBankAccount->account,
            'iban' => $companyBankAccount->iban,
            'default' => (boolean)$companyBankAccount->default,
            'company' => $companyBankAccount->company ? CompanyTransformer::toArray($companyBankAccount->company) : null,

            'created_at' => (string)$companyBankAccount->created_at,
            'updated_at' => (string)$companyBankAccount->updated_at,
            'deleted_at' => (string)$companyBankAccount->deleted_at,
        ];
    }

    /**
     * @param CompanyBankAccount $companyBankAccount
     * @return array
     */
    public static function toMaventaArray($companyBankAccount)
    {
        /**
         * $bank_accounts = array();
         *
         * $bank_account = array();
         * $bank_account['iban'] = 'FI1234561212244';
         * $bank_account['swift'] = 'TSTBNKFIHH';
         * $bank_account['account'] = null;
         * $bank_account['bank'] = null;
         * $bank_account['default'] = null;
         *
         * array_push($bank_accounts, $bank_account);
         */

        return [
            'bank' => $companyBankAccount->bank,
            'swift' => $companyBankAccount->swift,
            'account' => $companyBankAccount->account,
            'iban' => $companyBankAccount->iban,
            'default' => (boolean)$companyBankAccount->default,
        ];
    }

    /**
     * @param Collection $collection
     * @return Collection
     */
    public static function mapMaventa($collection)
    {
        return $collection->map(function ($item) {
            return self::toMaventaArray($item);
        });
    }
}
