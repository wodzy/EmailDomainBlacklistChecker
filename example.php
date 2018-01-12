<?php
require_once("Validator.php");

$file = 'data/blacklistDomains.json';
$test = new Walidoukaci\EmailDomainBlacklistChecker\Validator();
$response = $test->isBlacklisted($file, "john.doe@gmail.org");

if ($response) {

    echo 'This domain is valid';
} else {

    echo 'This domain is not valid';
}