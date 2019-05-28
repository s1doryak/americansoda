<?php

namespace Crmplease\Maventa;

/**
 * Class Maventa
 *
 * @method company_invoice_receiving()
 * @method company_list()
 * @method company_lookup()
 * @method company_lookup_with_operator()
 * @method company_settings_show()
 * @method company_settings_update()
 * @method configure_company()
 * @method show_company_configuration()
 * @method company_show()
 * @method hello_world()
 * @method inbound_invoice_show()
 * @method invoice_accept()
 * @method invoice_confirm()
 * @method invoice_create(array $invoice = [])
 * @method invoice_decline()
 * @method invoice_dispute()
 * @method invoice_list_between_dates()
 * @method invoice_list_inbound_between_dates()
 * @method invoice_list_ids()
 * @method invoice_put_file()
 * @method invoice_put_invoice()
 * @method invoice_put_invoice_with_metadata()
 * @method invoice_show($id, $include_files = null, $xmlformat = null)
 * @method invoice_state_list()
 * @method invoice_reroute()
 * @method partner_trx_list()
 * @method postal_address_create()
 * @method postal_address_delete()
 * @method postal_address_list()
 * @method postal_address_show()
 * @method postal_address_update()
 * @method register_with_password()
 * @method server_time()
 * @method user_create()
 * @method user_create_e()
 * @method user_delete()
 * @method user_list()
 * @method user_show()
 * @method user_update()
 * @method user_update_e()
 * @method update_logo()
 * @method remove_logo()
 * @method list_operators()
 * @method get_invoice_id()
 * @method get_invoice_image_as_format()
 * @method list_vendor_actions()
 * @method list_company_actions()
 * @method enable_operator()
 * @method link_vendor_api_key()
 * @method unlink_vendor_api_key()
 * @method list_vendor_inbound_invoices()
 * @method scan_account_order()
 * @method scan_account_show()
 * @method scan_account_disable()
 * @method invoice_put_finvoice()
 * @method b2c_issuer_agreement_order()
 * @method b2c_issuer_agreement_order_with_ocr()
 * @method disable_b2c_issuer_agreement()
 * @method get_consumer_link()
 * @method consumer_agreement_status()
 * @method consumer_agreements_query()
 * @method vendor_consumer_agreements_query()
 * @method token_login()
 * @method invoice_show_original_xml()
 * @method sent_invoices_status()
 *
 * @package Crmplease\Maventa
 */
class Maventa
{
	/**
	 * @var \SoapClient
	 */
	protected $client = null;

	/**
	 * @var null|string
	 */
	protected $user_api_key = null;

	/**
	 * @var null|string
	 */
	protected $company_uuid = null;

	/**
	 * @var null|string
	 */
	protected $vendor_api_key = null;

	/**
	 * @var null|string
	 */
	protected $base_url = 'https://testing.maventa.com/apis/v1.1/wsdl';

	/**
	 * @param string|null $user_api_key
	 * @param string|null $company_uuid
	 * @param string|null $vendor_api_key
	 * @param string|null $base_url
	 * @throws \SoapFault
	 */
	public function __construct($user_api_key = null, $company_uuid = null, $vendor_api_key = null, $base_url = null, array $options = ['trace' => true])
	{
		if (!is_null($user_api_key)) {
			$this->user_api_key = $user_api_key;
		}

		if (!is_null($company_uuid)) {
			$this->company_uuid = $company_uuid;
		}

		if (!is_null($vendor_api_key)) {
			$this->vendor_api_key = $vendor_api_key;
		}

		if (!is_null($base_url)) {
			$this->base_url = $base_url;
		}

		$this->client = new \SoapClient($this->base_url, $options);
	}

	/**
	 * @param string $user_api_key
	 *
	 * @return $this
	 */
	function setUserApiKey($user_api_key)
	{
		$this->user_api_key = $user_api_key;

		return $this;
	}

	/**
	 * @param string $company_uuid
	 *
	 * @return $this
	 */
	function setCompanyUuid($company_uuid)
	{
		$this->company_uuid = $company_uuid;

		return $this;
	}

	/**
	 * @param string $vendor_api_key
	 *
	 * @return $this
	 */
	function setVendorApiKey($vendor_api_key)
	{
		$this->vendor_api_key = $vendor_api_key;

		return $this;
	}

	/**
	 * @param string $base_url
	 *
	 * @return $this
	 */
	function setBaseUrl($base_url)
	{
		$this->base_url = $base_url;

		return $this;
	}

	/**
	 * @param string $method
	 * @param array $data
	 * @return object
	 */
	protected function execute($method, array $data = [])
	{
		$payload = [
			'user_api_key' => $this->user_api_key,
			'company_uuid' => $this->company_uuid,
			'vendor_api_key' => $this->vendor_api_key,
		];

		array_unshift($data, $payload);

		return call_user_func_array([$this->client, $method], $data);
	}

	/**
	 * @param string $name
	 * @param array $arguments
	 * @return object
	 */
	public function __call($name, $arguments)
	{
		return $this->execute($name, $arguments);
	}
}