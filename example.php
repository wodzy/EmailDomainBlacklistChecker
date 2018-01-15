<?php
require_once("src/Exception/CustomException.php");
require_once("src/Validator.php");

$file = 'src/data/blacklistDomains.json';
$test = new Wodzy\EmailDomainBlacklistChecker\Validator();
$response = $test->isBlacklisted($file, "john.doe@yopmail.com");

if ($response) {

    echo 'This domain is valid';
} else {

    echo 'This domain is not valid';
}