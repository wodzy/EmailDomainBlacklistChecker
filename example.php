<?php
require_once("src/Exception/CustomException.php");
require_once("src/Validator.php");

$response = \Wodzy\EmailDomainBlacklistChecker\Validator::isBlacklisted('john@yopmail.com');

if ($response) {

    echo "This domain is valid" . PHP_EOL;
} else {

    echo "This domain is not valid" . PHP_EOL;
}