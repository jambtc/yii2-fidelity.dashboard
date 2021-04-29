<?php
$secrets = require __DIR__ . '/secrets.php';

return [
    'adminEmail' => $secrets['mail_adminusername'],
    'senderEmail' => $secrets['mail_username'],
    'senderName' => $secrets['mail_name'],
    'logoApplicazione' => '/css/images/logo.png',
    'website' => 'www.txlab.it',
    'adminName' => 'txLab',
    'company' => 'txLab.it',
    'supportEmail' => $secrets['mail_support'],
    'encryptionFile' => dirname(__FILE__).'/encrypt.json',
    'icon-framework' => 'fa',  // Font Awesome Icon framework

    /**
     * Set the password reset token expiration time.
     */
    'user.passwordResetTokenExpire' => 3600,
    'user.passwordMinLength' => 8,

    /**
     * Set the list of usernames that we do not want to allow to users to take upon registration or profile change.
     */
    'user.spamNames' => 'admin|superadmin|creator|thecreator|username|administrator|root',


    /**
    * set the domain name to switch from dashboard and pos
    */
    'pos.domain' => $secrets['pos.domain'],
    'api.domain' => $secrets['api.domain'],


];
