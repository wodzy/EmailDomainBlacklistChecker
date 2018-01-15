<?php

namespace Wodzy\EmailDomainBlacklistChecker;

use Wodzy\EmailDomainBlacklistChecker\CustomException;

/* TODO: Test unit  and check uppercase domain*/

/**
 * Check if the domain is blacklisted
 *
 * @package walidoukaci\EmailDomainBlacklistChecker
 * @author  Walid Oukaci <walid.oukaci@gmail.com>
 * @license http://www.opensource.org/licenses/mit-license.php The MIT License
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
        $arrayEmail = explode("@", $email);
        $arrayEmail = explode(".", $arrayEmail[1]);

        return current($arrayEmail);
    }
}