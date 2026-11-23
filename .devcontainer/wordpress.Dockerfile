FROM wordpress:7.1.5-php8.3-apache

RUN a2enmod headers
RUN docker-php-ext-install opcache

RUN { \
		echo '<Directory /var/www/>'; \
		echo '    AllowOverride All'; \
		echo '</Directory>'; \
	} >> /etc/apache2/apache2.conf

RUN curl -o /usr/local/bin/wp -fSL https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar \
	&& chmod +x /usr/local/bin/wp

# Xdebug for step debugging (config in xdebug.ini, mounted by docker-compose.yml)
RUN pecl install xdebug-3.5.3 \
	&& docker-php-ext-enable xdebug
