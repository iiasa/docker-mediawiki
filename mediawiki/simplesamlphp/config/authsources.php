<?php

$config = array(
    // This is a authentication source which handles admin authentication.
    'admin' => array(
        // The default is to use core:AdminPassword, but it can be replaced with
        // any authentication source.
        'core:AdminPassword',
    ),
    'eduid' => array(
        'saml:SP',
        'privatekey' => 'saml.key',
        'certificate' => 'saml.crt',
        'sign.logout' => true,
        'signature.algorithm' => 'http://www.w3.org/2001/04/xmldsig-more#rsa-sha256',
        // The entity ID of this SP.
        'entityID' => 'https://wiki.ece.iiasa.ac.at/',
        // The entity ID of the IdP this should SP should contact.
        // Can be NULL/unset, in which case the user will be shown a list of available IdPs.
        'idp' => 'https://idp.iiasa.ac.at/idp/shibboleth',
        // The URL to the discovery service.
        // Can be NULL/unset, in which case a builtin discovery service will be used.
        // Or pick one from https://wiki.univie.ac.at/display/federation/Discovery+Services
        'discoURL' => null,
        // Not requesting a specific NameID format is essential for large-scale interop but
        // only works since SimpleSAMLphp 1.17.0 (and that had a bug fixed in 1.17.5):
        'NameIDPolicy' => false,

        'authproc' => array(
            // Create an intermediate attribute with NameID Format and Qualifiers spelled out:
            10 => array(
                'class' => 'saml:NameIDAttribute',
                'format' => '%F|%I!%S!%V',
                'attribute' => 'nameid_qualified',
            ),
            // Create 'persistent-id' attribute only from/for *persistent* NameIDs:
            20 => array(
                'class' => 'core:AttributeAlter',
                'subject' => 'nameid_qualified',
                'pattern' => '/^urn:oasis:names:tc:SAML:2\.0:nameid-format:persistent\|/',
                'target' => 'persistent-id',
                'replacement' => '',
            ),
        ),
    ),
);

# require(dirname(__FILE__) . '/../saml-autoconfig.php');
