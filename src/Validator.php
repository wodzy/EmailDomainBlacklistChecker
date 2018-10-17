<?php

namespace Wodzy\EmailDomainBlacklistChecker;

use Wodzy\EmailDomainBlacklistChecker\CustomException;

/**
 *
 * This file is part of EmailDomainBlacklistChecker
 * Validator class for check if the email domain is blacklisted
 *
 *
 * @package EmailDomainBlacklistChecker
 * @version 2.0.0
 * @author  Walid Oukaci <walid.oukaci@gmail.com>
 * @link    https://github.com/wodzy/EmailDomainBlacklistChecker
 * @license MIT License
 *
 */

class Validator
{

    private static $configFile;

    private static $blacklist = [];

    public static function isBlacklisted(string $email): bool
    {
        self::config();

        if ( ! file_exists(self::$blacklist['file'])) {
            throw new CustomException\CustomException(
                'Blacklist file not found');
        }

        switch (self::$blacklist['format']) {
            case 'json':
                $listDomains
                    = self::getDomainWithJson(self::$blacklist['file']);
                break;
            case 'php':
                $listDomains = self::getDomainWithPhp(self::$blacklist['file']);
                break;
            default:
                throw new CustomException\CustomException(
                    'Unknown format');
                break;
        }

        $domain = strtolower(self::getDomainFromEmail($email));

        return array_search($domain, $listDomains) === false;

    }

    private static function config()
    {
        self::$configFile = __DIR__ . '/config/config.php';
        if ( ! file_exists(self::$configFile)) {
            throw new CustomException\CustomException(
                'Config file not found');
        }

        $arrayConfig = require_once(self::$configFile);

        switch ($arrayConfig['config']['fileType']) {
            case 'json':
                self::$blacklist = [
                    'format' => 'json',
                    'file'   => __DIR__ . '/data/blacklistDomains.json',
                ];
                break;
            case 'php':
                self::$blacklist = [
                    'format' => 'php',
                    'file'   => __DIR__ . '/data/blacklistDomains.php',
                ];
                break;
            default:
                throw new CustomException\CustomException(
                    'Unknown file format');
                break;
        }
    }

    private static function getDomainWithJson(string $blacklist): array
    {
        $contents = file_get_contents($blacklist);
        $domainLists = json_decode($contents);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new CustomException\CustomException(json_last_error_msg());
        }

        return $domainLists->domains;
    }

    private static function getDomainWithPhp(string $blacklist): array
    {
        $contents[] = require($blacklist);
        $domainsLists = array_column($contents, 'domains');

        if (is_array($domainsLists)) {
            return $domainsLists[0];
        } else {
            throw new CustomException\CustomException(
                'You have a problem with your php array');
        }
    }

    public static function getDomainFromEmail(string $email): string
    {
        $emailDomain = substr(strrchr($email, "@"), 1);
        $arrayEmail = explode('.', $emailDomain);
        $tld = '.' . end($arrayEmail);
        $sld = str_replace($tld, '', $emailDomain);

        return $sld;
    }
}