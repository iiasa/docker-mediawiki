FROM mediawiki:1.42

# Create log directories
RUN mkdir -p /var/log/mediawiki /var/log/php && \
    chown www-data:www-data /var/log/mediawiki /var/log/php

# Reorganize MediaWiki to /wiki subdirectory
RUN mkdir /tmp/backup && \
    mv /var/www/html/* /tmp/backup && \
    mkdir /var/www/html/wiki && \
    mv /tmp/backup/* /var/www/html/wiki/ && \
    rm -rf /tmp/backup && \
    mkdir -p /var/www/html/wiki/images/tmp && \
    chown -R www-data:www-data /var/www/html/wiki/images

# Use production PHP configuration
RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini

# Install git and unzip for composer
RUN apt-get update && apt-get install -y git unzip && rm -rf /var/lib/apt/lists/*

# Install composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Install extensions using git clone - REL1_42
RUN git clone --depth 1 -b REL1_42 https://gerrit.wikimedia.org/r/mediawiki/extensions/PluggableAuth /var/www/html/wiki/extensions/PluggableAuth

RUN git clone --depth 1 -b REL1_42 https://gerrit.wikimedia.org/r/mediawiki/extensions/OpenIDConnect /var/www/html/wiki/extensions/OpenIDConnect

RUN git clone --depth 1 -b REL1_42 https://gerrit.wikimedia.org/r/mediawiki/extensions/intersection /var/www/html/wiki/extensions/intersection

RUN git clone --depth 1 -b REL1_42 https://gerrit.wikimedia.org/r/mediawiki/extensions/Loops /var/www/html/wiki/extensions/Loops

RUN git clone --depth 1 -b REL1_42 https://gerrit.wikimedia.org/r/mediawiki/extensions/Variables /var/www/html/wiki/extensions/Variables

RUN git clone --depth 1 -b REL1_42 https://gerrit.wikimedia.org/r/mediawiki/extensions/UploadWizard /var/www/html/wiki/extensions/UploadWizard

RUN git clone --depth 1 -b REL1_42 https://gerrit.wikimedia.org/r/mediawiki/extensions/Renameuser /var/www/html/wiki/extensions/Renameuser

RUN composer require jumbojett/openid-connect-php -d /var/www/html/wiki

# Copy custom configurations
COPY html/index.php /var/www/html/index.php
COPY etc/apache2/conf-available/docker-php.conf /etc/apache2/conf-available/docker-php.conf
COPY wiki/LocalSettings.php /var/www/html/wiki/LocalSettings.php
COPY wiki/resources/assets/* /var/www/html/wiki/resources/assets/
COPY wiki/skins/* /var/www/html/wiki/skins/
COPY wiki/favicon.ico /var/www/html/wiki/

WORKDIR /var/www/html/wiki