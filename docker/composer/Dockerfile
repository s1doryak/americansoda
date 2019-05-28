FROM crmplease/laravel-composer:7.3

# SOAP
RUN apt-get update -y; exit 0

RUN apt-get install -y \
	libxml2-dev \
	&& docker-php-ext-install soap

ENTRYPOINT ["php", "/usr/local/bin/composer"]
