FROM crmplease/laravel-queue:7.3

# SOAP
RUN docker-php-ext-install soap

CMD ["php", "artisan", "queue:listen"]
