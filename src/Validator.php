<?php

namespace Walidoukaci\EmailDomainBlacklistChecker;

/* TODO: Test unit and custom Exception */

/**
 * Check if the domain is blacklisted
 *
 * @package walidoukaci\EmailDomainBlacklistChecker
 * @author  Walid Oukaci <walid.oukaci@gmail.com>
 */
class Validator
{

    public function isBlacklisted(string $file, string $email): bool
    {
        $listDomains = $this->getDomainLists($file);
        $domain = $this->getDomainFromEmail($email);

        return array_search($domain, $listDomains) === false;
    }

    private function getDomainLists(string $file): array
    {

        $contents = file_get_contents($file);
        $domainLists = json_decode($contents);

        return $domainLists->domains;
    }

    private function getDomainFromEmail(string $email): string
    {
        $arrayEmail = explode("@", $email);
        $arrayEmail = explode(".", $arrayEmail[1]);

        return current($arrayEmail);
    }
}