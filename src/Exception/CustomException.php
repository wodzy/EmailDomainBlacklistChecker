<?php

namespace Wodzy\EmailDomainBlacklistChecker\CustomException;

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