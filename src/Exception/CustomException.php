<?php

namespace Wodzy\EmailDomainBlacklistChecker\CustomException;

/**
 *
 * This file is part of EmailDomainBlacklistChecker
 * @package EmailDomainBlacklistChecker
 * @version 2.0.0
 * @author  Walid Oukaci <walid.oukaci@gmail.com>
 * @link https://github.com/wodzy/EmailDomainBlacklistChecker
 * @license MIT License
 *
 */

class CustomException extends \Exception
{
    public function __construct(string $message)
    {
        parent::__construct($message);
    }

    public function __toString()
    {
        return $this->message;
    }
}