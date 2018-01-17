<?php

namespace Wodzy\EmailDomainBlacklistChecker;

use Wodzy\EmailDomainBlacklistChecker\CustomException;

/**
 *
 * This file is part of EmailDomainBlacklistChecker
 * Check if the email domain is blacklisted
 * @author  Walid Oukaci <walid.oukaci@gmail.com>
 * @license https://github.com/wodzy/EmailDomainBlacklistChecker/blob/master/LICENSE The MIT License
 *
 */

class Validator
{

    public function isBlacklisted(string $file, string $email): bool
    {
        if (! file_exists($file)) {
            throw new CustomException\CustomException('Blacklist file not found');
        }
        $listDomains = $this->getDomainLists($file);
        $domain = strtolower($this->getDomainFromEmail($email));

        return array_search($domain, $listDomains) === false;
    }

    private function getDomainLists(string $file): array
    {
        $contents = file_get_contents($file);
        $domainLists = json_decode($contents);
        if (json_last_error() !== JSON_ERROR_NONE) {
            throw new CustomException\CustomException(json_last_error_msg());
        }

        return $domainLists->domains;
    }

    private function getDomainFromEmail(string $email): string
    {
        $emailDomain = substr(strrchr($email, "@"), 1);
        $arrayEmail = explode('.', $emailDomain);
        $tld = '.' . end($arrayEmail);
        $sld = str_replace($tld, '', $emailDomain);

        return $sld;
    }
}