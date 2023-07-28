<?php

namespace Crmplease\Maventa;

use Crmplease\Maventa\Exceptions\Exception;

/**
 * Class Maventa
 *
 * @method b2c_issuer_agreement_order()
 * @method b2c_issuer_agreement_order_with_ocr()
 * @method company_invoice_receiving()
 * @method company_list()
 * @method company_lookup()
 * @method company_lookup_with_operator()
 * @method company_settings_show()
 * @method company_settings_update()
 * @method company_show()
 * @method configure_company()
 * @method consumer_agreement_status()
 * @method consumer_agreements_query()
 * @method disable_b2c_issuer_agreement()
 * @method enable_operator()
 * @method get_consumer_link()
 * @method get_invoice_id(string $invoice_number)
 * @method get_invoice_image_as_format(string $invoice_id, $format = "TIFF")
 * @method hello_world()
 * @method inbound_invoice_show()
 * @method invoice_accept()
 * @method invoice_confirm(string $id, string $payment_date)
 * @method invoice_create(object $invoice)
 * @method invoice_decline()
 * @method invoice_dispute()
 * @method invoice_list_between_dates(string $timestamp_start, string $timestamp_end, integer $all = null)
 * @method invoice_list_ids($direction, string $timestamp_start, string $timestamp_end, integer $all)
 * @method invoice_list_inbound_between_dates()
 * @method invoice_put_file()
 * @method invoice_put_finvoice()
 * @method invoice_put_invoice()
 * @method invoice_put_invoice_with_metadata()
 * @method invoice_reroute()
 * @method invoice_show(string $id, boolean $include_files = null, string $xmlformat = null)
 * @method invoice_show_original_xml()
 * @method invoice_state_list(array $invoiceIds = [])
 * @method link_vendor_api_key()
 * @method list_company_actions()
 * @method list_operators()
 * @method list_vendor_actions()
 * @method list_vendor_inbound_invoices()
 * @method partner_trx_list()
 * @method postal_address_create()
 * @method postal_address_delete()
 * @method postal_address_list()
 * @method postal_address_show()
 * @method postal_address_update()
 * @method register_with_password()
 * @method remove_logo()
 * @method scan_account_disable()
 * @method scan_account_order()
 * @method scan_account_show()
 * @method sent_invoices_status()
 * @method server_time()
 * @method show_company_configuration()
 * @method token_login(string $service)
 * @method unlink_vendor_api_key()
 * @method update_logo()
 * @method user_create()
 * @method user_create_e()
 * @method user_delete()
 * @method user_list()
 * @method user_show()
 * @method user_update()
 * @method user_update_e()
 * @method vendor_consumer_agreements_query()
 *
 * @package Crmplease\Maventa
 */
class Maventa
{
    /**
     * @var array
     */
    protected static $methodsAvailable = [
        'b2c_issuer_agreement_order',
        'b2c_issuer_agreement_order_with_ocr',
        'company_invoice_receiving',
        'company_list',
        'company_lookup',
        'company_lookup_with_operator',
        'company_settings_show',
        'company_settings_update',
        'company_show',
        'configure_company',
        'consumer_agreement_status',
        'consumer_agreements_query',
        'disable_b2c_issuer_agreement',
        'enable_operator',
        'get_consumer_link',
        'get_invoice_id',
        'get_invoice_image_as_format',
        'hello_world',
        'inbound_invoice_show',
        'invoice_accept',
        'invoice_confirm',
        'invoice_create',
        'invoice_decline',
        'invoice_dispute',
        'invoice_list_between_dates',
        'invoice_list_ids',
        'invoice_list_inbound_between_dates',
        'invoice_put_file',
        'invoice_put_finvoice',
        'invoice_put_invoice',
        'invoice_put_invoice_with_metadata',
        'invoice_reroute',
        'invoice_show',
        'invoice_show_original_xml',
        'invoice_state_list',
        'link_vendor_api_key',
        'list_company_actions',
        'list_operators',
        'list_vendor_actions',
        'list_vendor_inbound_invoices',
        'partner_trx_list',
        'postal_address_create',
        'postal_address_delete',
        'postal_address_list',
        'postal_address_show',
        'postal_address_update',
        'register_with_password',
        'remove_logo',
        'scan_account_disable',
        'scan_account_order',
        'scan_account_show',
        'sent_invoices_status',
        'server_time',
        'show_company_configuration',
        'token_login',
        'unlink_vendor_api_key',
        'update_logo',
        'user_create',
        'user_create_e',
        'user_delete',
        'user_list',
        'user_show',
        'user_update',
        'user_update_e',
        'vendor_consumer_agreements_query',
    ];

    /**
     * @var array
     */
    protected static $states = [
        0 => 'PENDING – Awaiting delivery (scheduled transmission)',
        1 => 'SENT – Invoice sent',
        2 => 'DECLINED – Rejected/declined by the recipient (Only e-mail and internal Maventa)',
        3 => 'ACCEPTED – approved/accepted by the recipient (Only e-mail and internal Maventa)',
        6 => 'PAID – Invoice marked as paid by sender (Internal Maventa only)',
        7 => 'VIEWED – Invoice link opened by the recipient',
        92 => 'DISPUTED – Dispueted by the recipient (Only internal Maventa)',
        99 => 'ERROR – Send error occurred',
    ];

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
        $payload = (object)[
            'user_api_key' => $this->user_api_key,
            'company_uuid' => $this->company_uuid,
            'vendor_api_key' => $this->vendor_api_key,
        ];

        array_unshift($data, $payload);

        return call_user_func_array([$this->client, $method], $data);
    }

    /**
     * @param string $method
     * @param array $arguments
     * @return object
     * @throws Exception
     */
    public function __call($method, $arguments)
    {
        if (in_array($method, self::$methodsAvailable)) {
            return $this->execute($method, $arguments);
        }

        throw new Exception(sprintf(
            'Call to undefined method %s::%s()', static::class, $method
        ));
    }
}
