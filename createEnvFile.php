#!/usr/bin/php
<?php
$configKeys = [
    'APP_ENV',
    'APP_DEBUG',
    'APP_SECRET',
    'VAR_DUMPER_FORMAT',
    'DATABASE_URL',
    'GOOGLE_RECAPTCHA_SITE_KEY',
    'GOOGLE_RECAPTCHA_SECRET',
    'EWZ_RECAPTCHA_SITE_KEY',
    'EWZ_RECAPTCHA_SECRET',
    'MAILER_DSN',
    'CONTACT_FORM_TO',
    'CONTACT_FORM_FROM',
];

$envFile = dirname(__FILE__) . '/.env';

$data = "";
foreach ($configKeys as $key) {
    $data .= sprintf("%s=%s\n", $key, getenv($key));
}

file_put_contents($envFile,$data);
echo "updated env file $envFile\n";
