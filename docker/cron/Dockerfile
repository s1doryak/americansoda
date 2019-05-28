FROM crmplease/laravel-artisan:7.3

# SOAP
RUN apt-get update -y; exit 0

RUN apt-get install -y \
	libxml2-dev \
	&& docker-php-ext-install soap

# Cron
RUN apt-get update && apt-get -y install -qq --force-yes cron

COPY cron /etc/cron.d/cron

RUN chmod 0644 /etc/cron.d/cron

RUN crontab /etc/cron.d/cron

ENTRYPOINT ["cron", "-f"]
