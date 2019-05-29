FROM crmplease/laravel-cron:7.3

# SOAP
RUN docker-php-ext-install soap

ENTRYPOINT ["cron", "-f"]
