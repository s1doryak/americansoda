<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
	/**
	 * The policy mappings for the application.
	 *
	 * @var array
	 */
	protected $policies = [
		\App\Region::class => \App\Policies\RegionPolicy::class,
		\App\Company::class => \App\Policies\CompanyPolicy::class,
		\App\Role::class => \App\Policies\RolePolicy::class,
		\App\User::class => \App\Policies\UserPolicy::class,
		\App\Brand::class => \App\Policies\BrandPolicy::class,
		\App\PackageType::class => \App\Policies\PackageTypePolicy::class,
		\App\ProductGroup::class => \App\Policies\ProductGroupPolicy::class,
		\App\Product::class => \App\Policies\ProductPolicy::class,
		\App\Stock::class => \App\Policies\StockPolicy::class,
		\App\PaymentType::class => \App\Policies\PaymentTypePolicy::class,
		\App\CustomerType::class => \App\Policies\CustomerTypePolicy::class,
		\App\Customer::class => \App\Policies\CustomerPolicy::class,
		\App\CustomerRevision::class => \App\Policies\CustomerRevisionPolicy::class,
		\App\CustomerOrder::class => \App\Policies\CustomerOrderPolicy::class,
		\App\CustomerShipment::class => \App\Policies\CustomerShipmentPolicy::class,
		\App\CustomerOrderItem::class => \App\Policies\CustomerOrderItemPolicy::class,
		\App\CustomerPricingPolicy::class => \App\Policies\CustomerPricingPolicyPolicy::class,
		\App\CustomerPricingPolicyRevision::class => \App\Policies\CustomerPricingPolicyRevisionPolicy::class,
		\App\Assembly::class => \App\Policies\AssemblyPolicy::class,
		\App\StockMovement::class => \App\Policies\StockMovementPolicy::class,
		\App\StockMovementProduct::class => \App\Policies\StockMovementProductPolicy::class,
		\App\StockProduct::class => \App\Policies\StockProductPolicy::class,
		\App\Job::class => \App\Policies\JobPolicy::class,
		\App\FailedJob::class => \App\Policies\FailedJobPolicy::class,
		\App\ProductTag::class => \App\Policies\ProductTagPolicy::class,
		\App\CompanyBankAccount::class => \App\Policies\CompanyBankAccountPolicy::class,
		\App\CustomerInvoice::class => \App\Policies\CustomerInvoicePolicy::class,
		\App\CustomerInvoiceAction::class => \App\Policies\CustomerInvoiceActionPolicy::class,
		\App\CustomerInvoiceAttachment::class => \App\Policies\CustomerInvoiceAttachmentPolicy::class,
		\App\CustomerInvoiceItem::class => \App\Policies\CustomerInvoiceItemPolicy::class,
		\App\PriceGroup::class => \App\Policies\PriceGroupPolicy::class,
		\App\PriceGroupBreakpoint::class => \App\Policies\PriceGroupBreakpointPolicy::class,
		\App\CustomerUser::class => \App\Policies\CustomerUserPolicy::class,
		\App\CustomerUserToken::class => \App\Policies\CustomerUserTokenPolicy::class,
		\App\CustomerPreOrder::class => \App\Policies\CustomerPreOrderPolicy::class,
		\App\CustomerPreOrderItem::class => \App\Policies\CustomerPreOrderItemPolicy::class,
        \App\Banner::class => \App\Policies\BannerPolicy::class,
\App\ProductType::class => \App\Policies\ProductTypePolicy::class,
\App\Setting::class => \App\Policies\SettingPolicy::class,
\App\AuthLog::class => \App\Policies\AuthLogPolicy::class,
\App\CustomerUserSubscribe::class => \App\Policies\CustomerUserSubscribePolicy::class,
\App\LtpMessage::class => \App\Policies\LtpMessagePolicy::class,





	];

	/**
	 * Register any authentication / authorization services.
	 *
	 * @return void
	 */
	public function boot()
	{
		$this->registerPolicies();

		//
	}
}
