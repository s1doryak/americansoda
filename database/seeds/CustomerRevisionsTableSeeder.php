<?php

use Illuminate\Database\Seeder;

class CustomerRevisionsTableSeeder extends Seeder
{
    public function run()
    {
		static $revisions, $editors, $stocks, $customerTypes, $paymentTypes, $users, $billingRegions, $shippingRegions;

		/** @var \Illuminate\Database\Eloquent\Collection $revisions */
		$revisions = $revisions ?: app(\App\Repositories\Contracts\RevisionRepository::class)->all();

		/** @var \Illuminate\Database\Eloquent\Collection $editors */
		$editors = $editors ?: app(\App\Repositories\Contracts\EditorRepository::class)->all();

		/** @var \Illuminate\Database\Eloquent\Collection $stocks */
		$stocks = $stocks ?: app(\App\Repositories\Contracts\StockRepository::class)->all();

		/** @var \Illuminate\Database\Eloquent\Collection $customerTypes */
		$customerTypes = $customerTypes ?: app(\App\Repositories\Contracts\CustomerTypeRepository::class)->all();

		/** @var \Illuminate\Database\Eloquent\Collection $paymentTypes */
		$paymentTypes = $paymentTypes ?: app(\App\Repositories\Contracts\PaymentTypeRepository::class)->all();

		/** @var \Illuminate\Database\Eloquent\Collection $users */
		$users = $users ?: app(\App\Repositories\Contracts\UserRepository::class)->all();

		/** @var \Illuminate\Database\Eloquent\Collection $billingRegions */
		$billingRegions = $billingRegions ?: app(\App\Repositories\Contracts\BillingRegionRepository::class)->all();

		/** @var \Illuminate\Database\Eloquent\Collection $shippingRegions */
		$shippingRegions = $shippingRegions ?: app(\App\Repositories\Contracts\ShippingRegionRepository::class)->all();



        factory(App\CustomerRevision::class, 5)->create()->each(function (App\CustomerRevision $customerRevision) use ($revisions, $editors, $stocks, $customerTypes, $paymentTypes, $users, $billingRegions, $shippingRegions) {
			$customerRevision->revision()->associate($revisions->random());
			$customerRevision->editor()->associate($editors->random());
			$customerRevision->stock()->associate($stocks->random());
			$customerRevision->customerType()->associate($customerTypes->random());
			$customerRevision->paymentType()->associate($paymentTypes->random());
			$customerRevision->user()->associate($users->random());
			$customerRevision->billingRegion()->associate($billingRegions->random());
			$customerRevision->shippingRegion()->associate($shippingRegions->random());

			$customerRevision->save();
        });
    }
}