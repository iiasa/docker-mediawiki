FROM mediawiki:1.35.2

RUN mkdir /var/log/mediawiki && \
    mkdir /var/log/php && \
    chown www-data:www-data /var/log/mediawiki && \
    chown www-data:www-data /var/log/php

RUN mkdir /tmp/backup && \
    mv /var/www/html/* /tmp/backup && \
    mkdir /var/www/html/wiki && \
    mv /tmp/backup/* /var/www/html/wiki/ && \
    mkdir /var/www/html/wiki/images/tmp 


RUN chown -R www-data:www-data /var/www/html/wiki/images

RUN cp /usr/local/etc/php/php.ini-production /usr/local/etc/php/php.ini

RUN php -r "copy('https://extdist.wmflabs.org/dist/extensions/PluggableAuth-REL1_35-d036ae0.tar.gz', 'PluggableAuth-REL1_35-d036ae0.tar.gz');" && \
    tar -xzf PluggableAuth-REL1_35-d036ae0.tar.gz -C /var/www/html/wiki/extensions && \
    rm -rf PluggableAuth-REL1_35-d036ae0.tar.gz

RUN php -r "copy('https://extdist.wmflabs.org/dist/extensions/OpenIDConnect-REL1_35-19f4221.tar.gz', 'OpenIDConnect-REL1_35-19f4221.tar.gz');" && \
    tar -xzf OpenIDConnect-REL1_35-19f4221.tar.gz -C /var/www/html/wiki/extensions && \
    rm -rf OpenIDConnect-REL1_35-19f4221.tar.gz

RUN php -r "copy('https://extdist.wmflabs.org/dist/extensions/intersection-REL1_35-1adb683.tar.gz', 'intersection-REL1_35-1adb683.tar.gz');" && \
    tar -xzf intersection-REL1_35-1adb683.tar.gz -C /var/www/html/wiki/extensions && \
    rm -rf intersection-REL1_35-1adb683.tar.gz

RUN php -r "copy('https://extdist.wmflabs.org/dist/extensions/Loops-REL1_35-f0f1191.tar.gz', 'Loops-REL1_35-f0f1191.tar.gz');" && \
    tar -xzf Loops-REL1_35-f0f1191.tar.gz -C /var/www/html/wiki/extensions && \
    rm -rf /var/www/html/Loops-REL1_35-f0f1191.tar.gz

RUN php -r "copy('https://extdist.wmflabs.org/dist/extensions/Variables-REL1_35-e20f4c7.tar.gz', 'Variables-REL1_35-e20f4c7.tar.gz');" && \
    tar -xzf Variables-REL1_35-e20f4c7.tar.gz -C /var/www/html/wiki/extensions && \
    rm -rf /var/www/html/Variables-REL1_35-e20f4c7.tar.gz

RUN php -r "copy('https://extdist.wmflabs.org/dist/extensions/UploadWizard-REL1_35-c54e588.tar.gz', 'UploadWizard-REL1_35-c54e588.tar.gz');" && \
    tar -xzf UploadWizard-REL1_35-c54e588.tar.gz -C /var/www/html/wiki/extensions && \
    rm -rf /var/www/html/UploadWizard-REL1_35-c54e588.tar.gz

COPY html/index.php /var/www/html/index.php

COPY etc/apache2/conf-available/docker-php.conf /etc/apache2/conf-available/docker-php.conf

COPY wiki/LocalSettings.php /var/www/html/wiki/LocalSettings.php
COPY wiki/resources/assets/* /var/www/html/wiki/resources/assets/
COPY wiki/skins/* /var/www/html/wiki/skins
COPY wiki/favicon.ico /var/www/html/wiki 

WORKDIR /var/www/html/wiki
