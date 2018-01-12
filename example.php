<?php
require_once("src/Validator.php");

$file = 'src/data/blacklistDomains.json';
$test = new Walidoukaci\EmailDomainBlacklistChecker\Validator();
$response = $test->isBlacklisted($file, "john.doe@gmail.org");

if ($response) {

    echo 'This domain is valid';
} else {

    echo 'This domain is not valid';
}