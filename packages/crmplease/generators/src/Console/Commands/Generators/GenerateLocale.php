<?php

namespace Crmplease\Generators\Console\Commands\Generators;

use Illuminate\Support\Collection;
use Symfony\Component\Console\Input\InputArgument;

class GenerateLocale extends GeneratorCommand
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'generate:locale';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Generate locale';

    /**
     * The type of class being generated.
     *
     * @var string
     */
    protected $type = 'Locale';

    /**
     * Locale code. Example: en.
     *
     * @var string
     */
    protected $locale;

    /**
     * Locale name. Example: en_US.
     *
     * @var string
     */
    protected $localeName;

    /**
     * Locale list.
     *
     * @see /usr/share/i18n/SUPPORTED
     *
     * @var array
     */
    protected $localeList = [
        'aa_DJ',
        'aa_ER',
        'aa_ET',
        'af_ZA',
        'ak_GH',
        'am_ET',
        'an_ES',
        'anp_IN',
        'ar_AE',
        'ar_BH',
        'ar_DZ',
        'ar_EG',
        'ar_IN',
        'ar_IQ',
        'ar_JO',
        'ar_KW',
        'ar_LB',
        'ar_LY',
        'ar_MA',
        'ar_OM',
        'ar_QA',
        'ar_SA',
        'ar_SD',
        'ar_SS',
        'ar_SY',
        'ar_TN',
        'ar_YE',
        'ayc_PE',
        'az_AZ',
        'as_IN',
        'ast_ES',
        'be_BY',
        'bem_ZM',
        'ber_DZ',
        'ber_MA',
        'bg_BG',
        'bhb_IN',
        'bho_IN',
        'bn_BD',
        'bn_IN',
        'bo_CN',
        'bo_IN',
        'br_FR',
        'brx_IN',
        'bs_BA',
        'byn_ER',
        'ca_AD',
        'ca_ES',
        'ca_FR',
        'ca_IT',
        'ce_RU',
        'ckb_IQ',
        'cmn_TW',
        'crh_UA',
        'cs_CZ',
        'csb_PL',
        'cv_RU',
        'cy_GB',
        'da_DK',
        'de_AT',
        'de_BE',
        'de_CH',
        'de_DE',
        'de_LI',
        'de_LU',
        'doi_IN',
        'dv_MV',
        'dz_BT',
        'el_GR',
        'el_CY',
        'en_AG',
        'en_AU',
        'en_BW',
        'en_CA',
        'en_DK',
        'en_GB',
        'en_HK',
        'en_IE',
        'en_IN',
        'en_NG',
        'en_NZ',
        'en_PH',
        'en_SG',
        'en_US',
        'en_ZA',
        'en_ZM',
        'en_ZW',
        'eo',
        'eo_US',
        'es_AR',
        'es_BO',
        'es_CL',
        'es_CO',
        'es_CR',
        'es_CU',
        'es_DO',
        'es_EC',
        'es_ES',
        'es_GT',
        'es_HN',
        'es_MX',
        'es_NI',
        'es_PA',
        'es_PE',
        'es_PR',
        'es_PY',
        'es_SV',
        'es_US',
        'es_UY',
        'es_VE',
        'et_EE',
        'eu_ES',
        'eu_FR',
        'fa_IR',
        'ff_SN',
        'fi_FI',
        'fil_PH',
        'fo_FO',
        'fr_BE',
        'fr_CA',
        'fr_CH',
        'fr_FR',
        'fr_LU',
        'fur_IT',
        'fy_NL',
        'fy_DE',
        'ga_IE',
        'gd_GB',
        'gez_ER',
        'gez_ET',
        'gl_ES',
        'gu_IN',
        'gv_GB',
        'ha_NG',
        'hak_TW',
        'he_IL',
        'hi_IN',
        'hne_IN',
        'hr_HR',
        'hsb_DE',
        'ht_HT',
        'hu_HU',
        'hy_AM',
        'ia_FR',
        'id_ID',
        'ig_NG',
        'ik_CA',
        'is_IS',
        'it_CH',
        'it_IT',
        'iu_CA',
        'iw_IL',
        'ja_JP',
        'ka_GE',
        'kk_KZ',
        'kl_GL',
        'km_KH',
        'kn_IN',
        'ko_KR',
        'kok_IN',
        'ks_IN',
        'ku_TR',
        'kw_GB',
        'ky_KG',
        'lb_LU',
        'lg_UG',
        'li_BE',
        'li_NL',
        'lij_IT',
        'ln_CD',
        'lo_LA',
        'lt_LT',
        'lv_LV',
        'lzh_TW',
        'mag_IN',
        'mai_IN',
        'mg_MG',
        'mhr_RU',
        'mi_NZ',
        'mk_MK',
        'ml_IN',
        'mn_MN',
        'mni_IN',
        'mr_IN',
        'ms_MY',
        'mt_MT',
        'my_MM',
        'nan_TW',
        'nb_NO',
        'nds_DE',
        'nds_NL',
        'ne_NP',
        'nhn_MX',
        'niu_NU',
        'niu_NZ',
        'nl_AW',
        'nl_BE',
        'nl_NL',
        'nn_NO',
        'nr_ZA',
        'nso_ZA',
        'oc_FR',
        'om_ET',
        'om_KE',
        'or_IN',
        'os_RU',
        'pa_IN',
        'pa_PK',
        'pap_AN',
        'pap_AW',
        'pap_CW',
        'pl_PL',
        'ps_AF',
        'pt_BR',
        'pt_PT',
        'quz_PE',
        'raj_IN',
        'ro_RO',
        'ru_RU',
        'ru_UA',
        'rw_RW',
        'sa_IN',
        'sat_IN',
        'sc_IT',
        'sd_IN',
        'sd_PK',
        'se_NO',
        'shs_CA',
        'si_LK',
        'sid_ET',
        'sk_SK',
        'sl_SI',
        'so_DJ',
        'so_ET',
        'so_KE',
        'so_SO',
        'sq_AL',
        'sq_MK',
        'sr_ME',
        'sr_RS',
        'ss_ZA',
        'st_ZA',
        'sv_FI',
        'sv_SE',
        'sw_KE',
        'sw_TZ',
        'szl_PL',
        'ta_IN',
        'ta_LK',
        'tcy_IN',
        'te_IN',
        'tg_TJ',
        'th_TH',
        'the_NP',
        'ti_ER',
        'ti_ET',
        'tig_ER',
        'tk_TM',
        'tl_PH',
        'tn_ZA',
        'tr_CY',
        'tr_TR',
        'ts_ZA',
        'tt_RU',
        'ug_CN',
        'uk_UA',
        'unm_US',
        'ur_IN',
        'ur_PK',
        'uz_UZ',
        've_ZA',
        'vi_VN',
        'wa_BE',
        'wae_CH',
        'wal_ET',
        'wo_SN',
        'xh_ZA',
        'yi_US',
        'yo_NG',
        'yue_HK',
        'zh_CN',
        'zh_HK',
        'zh_SG',
        'zh_TW',
        'zu_ZA',
    ];

    /**
     * Locale directories.
     *
     * @var array
     */
    protected $localeDirectories = [
        'resources/lang/{{locale}}',
        'resources/lang/{{locale}}/models',
        'resources/lang/{{locale}}/notifications',
        'resources/lang/{{locale}}/pages',
    ];

    /**
     * Locale files.
     *
     * @var array
     */
    protected $localeFiles = [
        'resources/lang/{{locale}}/notifications/password_reset.php' => 'notifications/password_reset',
        'resources/lang/{{locale}}/pages/home.php' => 'pages/home',
        'resources/lang/{{locale}}/auth.php' => 'auth',
		'resources/lang/{{locale}}/colors.php' => 'colors',
        'resources/lang/{{locale}}/datatables.php' => 'datatables',
        'resources/lang/{{locale}}/daterangepicker.php' => 'daterangepicker',
        'resources/lang/{{locale}}/email.php' => 'email',
        'resources/lang/{{locale}}/footer.php' => 'footer',
        'resources/lang/{{locale}}/forms.php' => 'forms',
        'resources/lang/{{locale}}/fullcalendar.php' => 'fullcalendar',
        'resources/lang/{{locale}}/generator.php' => 'generator',
        'resources/lang/{{locale}}/header.php' => 'header',
        'resources/lang/{{locale}}/locales.php' => 'locales',
        'resources/lang/{{locale}}/modals.php' => 'modals',
        'resources/lang/{{locale}}/page-loader.php' => 'page-loader',
        'resources/lang/{{locale}}/pagination.php' => 'pagination',
        'resources/lang/{{locale}}/passwords.php' => 'passwords',
        'resources/lang/{{locale}}/sidebar.php' => 'sidebar',
        'resources/lang/{{locale}}/validation.php' => 'validation',
    ];

    /**
     * @return array
     */
    public function getLocales()
    {
        return collect($this->localeList)->map(function ($locale) {

            $parts = explode('_', $locale);

            return [
                'code' => $parts[0],
                'name' => isset($parts[1]) ? sprintf('%s_%s', $parts[0], $parts[1]) : $parts[0]
            ];
        })->groupBy('code')->map(function (Collection $items) {
            return $items->pluck('name')->toArray();
        })->toArray();
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * @return string
     */
    public function getLocaleName()
    {
        return $this->localeName;
    }

    /**
     * Execute the console command.
     *
     * @return boolean|null|void
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    public function handle()
    {
        if (false === $name = $this->handleName()) {
            return false;
        }

        $parts = explode('_', $name);

        $this->locale = array_shift($parts);

        if (count($parts)) {
            $this->localeName = sprintf('%s_%s', $this->locale, array_shift($parts));
        }

        $locales = $this->getLocales();

        if (isset($locales[$this->locale])) {

            if (count($locales[$this->locale]) > 1) {
                if ($this->localeName) {
                    if (!in_array($this->localeName, $locales[$this->locale])) {
                        $this->error(sprintf("Unsupported locale name: %s", $this->localeName));
                        return;
                    }
                } else {
                    $this->localeName = $this->choice('Please choose locale name:', $locales[$this->locale]);
                }
            } else {
                $locales[$this->locale] = array_shift($locales[$this->locale]);

                if ($this->localeName) {
                    if ($this->localeName !== $locales[$this->locale]) {
                        $this->error(sprintf("Unsupported locale name: %s", $this->localeName));
                        return;
                    }
                } else {
                    $this->localeName = $locales[$this->locale];
                }
            }

        } else {
            $this->error(sprintf("Unsupported locale code: %s", $this->locale));
            return;
        }

        $search = [
            '{{locale}}',
            '{{locale_name}}',
        ];

        $replace = [
            $this->locale,
            $this->localeName
        ];

        /**
         * Make directories
         */
        foreach ($this->localeDirectories as $directory) {

            $path = $this->basePath(str_replace($search, $replace, $directory));

            $this->makeDirectory($path);
        }

        /**
         * Make files
         */
        foreach ($this->localeFiles as $file => $type) {

            $path = $this->basePath(str_replace($search, $replace, $file));

            $this->makeFile($path, $this->buildClass($this->locale, $type));
        }

        $this->success();
    }

    /**
     * Build the class with the given name.
     *
     * @param string $locale
     * @param string $type
     * @return string
     *
     * @throws \Illuminate\Contracts\Filesystem\FileNotFoundException
     */
    protected function buildClass($locale, $type = '')
    {
        $stub = $this->files->get($this->getStub($locale, $type));

        return $this->replaceClass($stub, $locale);
    }

    /**
     * Get the stub file for the generator.
     *
     * @param string $locale
     * @param string $type
     * @return string
     */
    protected function getStub($locale = '', $type = '')
    {
        $stub = sprintf(__DIR__ . '/stubs/locale/%s/%s.stub', $locale, $type);

        if ($this->files->exists($stub)) {
            return $stub;
        }

        return sprintf(__DIR__ . '/stubs/locale/%s.stub', $type);
    }

    /**
     * Replace the class name for the given stub.
     *
     * @param string $stub
     * @param string $locale
     * @return string
     */
    protected function replaceClass($stub, $locale)
    {
        $search = [
            '{{locale}}',
            '{{locale_name}}',
        ];

        $replace = [
            $this->locale,
            $this->localeName
        ];

        return str_replace($search, $replace, $stub);
    }

    /**
     * Display success message to console.
     */
    protected function success()
    {
        parent::success();

        $this->updateCodeSuggestion(
            'config/locales.php',
            'php',
            sprintf(
                implode("\n", [
                    "'%s' => '%s',",
                ]),
                $this->locale,
                $this->localeName
            ),
            1,
            'array_return'
        );

        $this->info(sprintf('%s locate created successfully.', $this->localeName));

        return true;
    }

    /**
     * Get the console command arguments.
     *
     * @return array
     */
    protected function getArguments()
    {
        return [
            ['name', InputArgument::OPTIONAL, 'The name of the locale.'],
        ];
    }
}
