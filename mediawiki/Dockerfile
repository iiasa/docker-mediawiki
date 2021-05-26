FROM jwitrick/okta-simplesamlphp as simplesamlphp

FROM mediawiki:1.35.1

RUN apt-get update && \
    apt-get install -y --allow-unauthenticated libldap2-dev

RUN docker-php-ext-configure ldap --with-libdir=lib/x86_64-linux-gnu/
RUN apt-get install -y apt-transport-https lsb-release gnupg cron
RUN curl -sL https://deb.nodesource.com/setup_14.x | bash -
RUN apt-get install build-essential nodejs sqlite3 libsqlite3-dev -y
RUN docker-php-ext-install ldap

RUN docker-php-ext-install pdo pdo_mysql && \
    docker-php-ext-configure pdo_sqlite && \
    docker-php-ext-install pdo_sqlite

COPY --from=simplesamlphp /var/simplesamlphp /var/simplesamlphp

RUN cd /var/simplesamlphp && \
    cp -r config-templates/acl.php config/acl.php && \
    cp -r metadata-templates/* metadata/

RUN mkdir /tmp/backup && \
    mv /var/www/html/* /tmp/backup && \
    mkdir /var/www/html/wiki && \
    mv /tmp/backup/* /var/www/html/wiki/

RUN php -r "copy('https://extdist.wmflabs.org/dist/extensions/PluggableAuth-REL1_32-cdeff81.tar.gz', 'PluggableAuth-REL1_32-cdeff81.tar.gz');" && \
    tar -xzf PluggableAuth-REL1_32-cdeff81.tar.gz -C /var/www/html/wiki/extensions && \
    rm -rf PluggableAuth-REL1_32-cdeff81.tar.gz

RUN php -r "copy('https://extdist.wmflabs.org/dist/extensions/SimpleSAMLphp-REL1_32-72b213a.tar.gz', 'SimpleSAMLphp-REL1_32-72b213a.tar.gz');" && \
    tar -xzf SimpleSAMLphp-REL1_32-72b213a.tar.gz -C /var/www/html/wiki/extensions && \
    rm -rf /var/www/html/SimpleSAMLphp-REL1_32-72b213a.tar.gz

RUN ln -s /var/simplesamlphp/www /var/www/html/simplesamlphp

RUN mkdir /var/simplesamlphp/data/db && \
    chown www-data:www-data /var/simplesamlphp/data/db

COPY html/index.php /var/www/html/index.php

COPY simplesamlphp/cert/* /var/simplesamlphp/cert/
COPY simplesamlphp/config/* /var/simplesamlphp/config/
# COPY simplesamlphp/metadata/* /var/simplesamlphp/metadata/
# COPY simplesamlphp/saml-autoconfig.php /var/simplesamlphp/saml-autoconfig.php

COPY wiki/extensions/SimpleSAMLphp/includes/SimpleSAMLphp.php /var/www/html/wiki/extensions/SimpleSAMLphp/includes/
COPY etc/apache2/conf-available/docker-php.conf /etc/apache2/conf-available/docker-php.conf

COPY wiki/LocalSettings.php /var/www/html/wiki/LocalSettings.php

RUN /var/simplesamlphp/modules/metarefresh/bin/metarefresh.php -o=metadata/aconet http://eduid.at/md/aconet-registered.xml --certificate=aconet-metadata-signing.crt 
