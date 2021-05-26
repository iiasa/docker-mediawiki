<?php
$config = array(
    'sets' => array(
        'aconet' => array(
            'cron' => array('hourly', 'daily'),
            'sources' => array(
                array(
                    #'blacklist' => array(
                    #    'https://openidp.aco.net/saml',
                    #),
                    'whitelist' => array(
                        'https://idp.iiasa.ac.at/idp/shibboleth',
                    ),
                    'conditionalGET' => TRUE,
                    'src' => 'http://eduid.at/md/aconet-registered.xml',
                    'certificates' => array('aconet-metadata-signing.crt'),
                    'types' => array('saml20-idp-remote'),
                ),
            ),
            'expireAfter'  => 60 * 60 * 24 * 3, // Maximum 3 days cache time
            'outputDir'    => 'metadata/aconet/',
            'outputFormat' => 'flatfile',
        ),
    ),
);
