<?php

namespace App\Forms\Dashboard;

use App\Customer;
use App\CustomerPricingPolicy;
use App\Repositories\Contracts\CustomerRepository;
use App\Repositories\Contracts\ProductGroupRepository;
use Crmplease\MaterialAdmin\Forms\Form;
use Illuminate\Validation\Rule;

/**
 * Customer form.
 *
 * @package App\Forms\Dashboard
 */
class CustomerForm extends Form
{
    /**
     * @return array
     */
    public static function getCreateFormFields()
    {
        $incomterms = config('customer.incomterms');
        $delivery_payer = config('customer.delivery_payer');

        $fields = [
            'archived' => [
                'type' => 'checkbox',
                'ts-color' => 'red',
            ],
            'name' => 'text',
            'legal_name' => 'text',

            'billingRegion' => [
                'type' => 'choice',
                'multiple' => false,
                'resource' => 'region',
                'selected' => null,
            ],
            'billing_postcode' => 'text',
            'billing_address' => 'text',

            'shippingRegion' => [
                'type' => 'choice',
                'multiple' => false,
                'resource' => 'region',
                'selected' => null,
            ],
            'shipping_postcode' => 'text',
            'shipping_address' => 'text',
            'country' => 'text',
            'state' => 'text',
            'post_code' => 'text',
            'post_office' => 'text',
            'address1' => 'text',
            'address2' => 'text',
            'contact_p' => 'text',
            'nr' => [
                'type' => 'text',
                'value' => app(CustomerRepository::class)->getFirstAvailableNumber()
            ],
            'y_tunnus' => 'text',
            'bid' => 'text',
            'ovt' => 'text',
            'iban' => 'text',
            'swift' => 'text',
            'email' => 'text',
            'phone' => 'text',
            'user' => [
                'type' => 'choice',
                'multiple' => false,
            ],
            'stock' => [
                'type' => 'choice',
                'multiple' => false,
            ],
            'customerType' => [
                'type' => 'choice',
                'multiple' => false,
            ],
            'paymentType' => [
                'type' => 'choice',
                'multiple' => false,
            ],
            'priceGroup' => [
                'type' => 'choice',
                'multiple' => false,
            ],
            'payment_conditions' => 'text',
            'pays_vat' => [
                'type' => 'hidden',
                'value' => true
            ],
            'order_interval' => 'text',
            'delivery_payer' => [
                'type' => 'select',
                'choices' => array_combine($delivery_payer, $delivery_payer),
                'selected' => null,
            ],
            'incomterms' => [
                'type' => 'select',
                'choices' => array_combine($incomterms, $incomterms),
                'selected' => null,
            ],
            'comment' => 'editor',
            'terms_of_cooperation' => 'editor',
            'terms_of_delivery' => 'editor',
            'terms_of_equipment' => 'editor',
        ];

        $policies = [
            'type' => 'relation_form',
            'resource' => 'customer_pricing_policy',
            'form_title' => trans('models/customer_pricing_policy.labels.plural'),
            'template' => 'dashboard::resources.customer.policies.form',
            'groups' => app(ProductGroupRepository::class)->all(),
            'fields' => CustomerPricingPolicyForm::getCreateFormFields(),
            'items' => collect(),
        ];

        $fields['customerPricingPolicies[idx]'] = $policies;

        return $fields;
    }

    /**
     * @param Customer $customer
     * @return array
     */
    public static function getEditFormFields($customer)
    {
        $incomterms = config('customer.incomterms');
        $delivery_payer = config('customer.delivery_payer');

        $fields = [
            'archived' => [
                'type' => 'checkbox',
                'ts-color' => 'red',
            ],
            'name' => 'text',
            'legal_name' => 'text',

            'billingRegion' => [
                'type' => 'choice',
                'multiple' => false,
                'resource' => 'region',
                'selected' => $customer ? $customer->billingRegion->getKey() : null,
            ],
            'billing_postcode' => 'text',
            'billing_address' => 'text',

            'shippingRegion' => [
                'type' => 'choice',
                'multiple' => false,
                'resource' => 'region',
                'selected' => $customer ? $customer->shippingRegion->getKey() : null,
            ],
            'shipping_postcode' => 'text',
            'shipping_address' => 'text',
            'country' => 'text',
            'state' => 'text',
            'post_code' => 'text',
            'post_office' => 'text',
            'address1' => 'text',
            'address2' => 'text',
            'contact_p' => 'text',
            'nr' => 'text',
            'y_tunnus' => 'text',
            'bid' => 'text',
            'ovt' => 'text',
            'iban' => 'text',
            'swift' => 'text',
            'email' => 'text',
            'phone' => 'text',
            'user' => [
                'type' => 'choice',
                'multiple' => false,
            ],
            'stock' => [
                'type' => 'choice',
                'multiple' => false,
            ],
            'customerType' => [
                'type' => 'choice',
                'multiple' => false,
            ],
            'paymentType' => [
                'type' => 'choice',
                'multiple' => false,
            ],
            'priceGroup' => [
                'type' => 'choice',
                'multiple' => false,
            ],
            'payment_conditions' => 'text',
            'pays_vat' => [
                'type' => 'hidden',
                'value' => true
            ],
            'order_interval' => 'text',
            'delivery_payer' => [
                'type' => 'select',
                'choices' => array_combine($delivery_payer, $delivery_payer),
                'selected' => $customer ? $customer->delivery_payer : null,
            ],
            'incomterms' => [
                'type' => 'select',
                'choices' => array_combine($incomterms, $incomterms),
                'selected' => $customer ? $customer->incomterms : null,
            ],
            'comment' => 'editor',
            'terms_of_cooperation' => 'editor',
            'terms_of_delivery' => 'editor',
            'terms_of_equipment' => 'editor',
        ];

        $fields['customerPricingPolicies[idx]'] = [
            'type' => 'relation_form',
            'resource' => 'customer_pricing_policy',
            'form_title' => trans('models/customer_pricing_policy.labels.plural'),
            'template' => 'dashboard::resources.customer.policies.form',
            'groups' => app(ProductGroupRepository::class)->all(),
            'fields' => CustomerPricingPolicyForm::getCreateFormFields(),
            'items' => $customer->customerPricingPolicies
                ->filter(function (CustomerPricingPolicy $customerPricingPolicy) {
                    return false === $customerPricingPolicy->trashed();
                })
                ->groupBy(function (CustomerPricingPolicy $customerPricingPolicy) {
                    return $customerPricingPolicy->productGroup->getKey() ?? null;
                }),
        ];

        return $fields;
    }

    /**
     * @return array
     */
    public static function getStoreValidationRules()
    {
        return [
            'name' => 'sometimes',
            'legal_name' => 'sometimes',

            'billingRegion' => 'sometimes|exists:regions,id',
            'billing_postcode' => 'sometimes',
            'billing_address' => 'sometimes',

            'shippingRegion' => 'sometimes|exists:regions,id',
            'shipping_postcode' => 'sometimes',
            'shipping_address' => 'sometimes',

            'bid' => 'sometimes', // Business ID
            'email' => 'sometimes',
            'stock' => 'sometimes|exists:stocks,id',
            'customerType' => 'sometimes|exists:customer_types,id',
            'paymentType' => 'sometimes|exists:payment_types,id',
            'user' => 'sometimes|exists:users,id',
            'archived' => 'sometimes',
            'nr' => 'sometimes',
            'country' => 'sometimes',
            'state' => 'sometimes',
            'post_code' => 'sometimes',
            'post_office' => 'sometimes',
            'address1' => 'sometimes',
            'address2' => 'sometimes',
            'contact_p' => 'sometimes',
            'ovt' => 'sometimes',
            'priceGroup' => 'sometimes|exists:price_groups,id',
            'y_tunnus' => 'sometimes',
        ];
    }

    /**
     * @param Customer $customer
     * @return array
     */
    public static function getUpdateValidationRules($customer)
    {
        return [
            'name' => 'sometimes',
            'legal_name' => 'sometimes',

            'billingRegion' => 'sometimes|exists:regions,id',
            'billing_postcode' => 'sometimes',
            'billing_address' => 'sometimes',

            'shippingRegion' => 'sometimes|exists:regions,id',
            'shipping_postcode' => 'sometimes',
            'shipping_address' => 'sometimes',

            'bid' => 'sometimes', // Business ID
            'email' => 'sometimes',
            'stock' => 'sometimes|exists:stocks,id',
            'customerType' => 'sometimes|exists:customer_types,id',
            'paymentType' => 'sometimes|exists:payment_types,id',
            'user' => 'sometimes|exists:users,id',
            'archived' => 'sometimes',
            'nr' => 'sometimes',
            'country' => 'sometimes',
            'state' => 'sometimes',
            'post_code' => 'sometimes',
            'post_office' => 'sometimes',
            'address1' => 'sometimes',
            'address2' => 'sometimes',
            'contact_p' => 'sometimes',
            'ovt' => 'sometimes',
            'priceGroup' => 'sometimes|exists:price_groups,id',
            'y_tunnus' => 'sometimes',
        ];
    }
}
