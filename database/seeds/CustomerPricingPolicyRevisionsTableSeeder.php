<?php

use Illuminate\Database\Seeder;

class CustomerPricingPolicyRevisionsTableSeeder extends Seeder
{
    public function run()
    {
		static $revisions, $customerPricingPolicies, $editors, $productGroups, $customers;

		/** @var \Illuminate\Database\Eloquent\Collection $revisions */
		$revisions = $revisions ?: app(\App\Repositories\Contracts\RevisionRepository::class)->all();

		/** @var \Illuminate\Database\Eloquent\Collection $customerPricingPolicies */
		$customerPricingPolicies = $customerPricingPolicies ?: app(\App\Repositories\Contracts\CustomerPricingPolicyRepository::class)->all();

		/** @var \Illuminate\Database\Eloquent\Collection $editors */
		$editors = $editors ?: app(\App\Repositories\Contracts\EditorRepository::class)->all();

		/** @var \Illuminate\Database\Eloquent\Collection $productGroups */
		$productGroups = $productGroups ?: app(\App\Repositories\Contracts\ProductGroupRepository::class)->all();

		/** @var \Illuminate\Database\Eloquent\Collection $customers */
		$customers = $customers ?: app(\App\Repositories\Contracts\CustomerRepository::class)->all();



        factory(App\CustomerPricingPolicyRevision::class, 5)->create()->each(function (App\CustomerPricingPolicyRevision $customerPricingPolicyRevision) use ($revisions, $customerPricingPolicies, $editors, $productGroups, $customers) {
			$customerPricingPolicyRevision->revision()->associate($revisions->random());
			$customerPricingPolicyRevision->customerPricingPolicy()->associate($customerPricingPolicies->random());
			$customerPricingPolicyRevision->editor()->associate($editors->random());
			$customerPricingPolicyRevision->productGroup()->associate($productGroups->random());
			$customerPricingPolicyRevision->customer()->associate($customers->random());

			$customerPricingPolicyRevision->save();
        });
    }
}