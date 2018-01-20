# Email Domain Blacklist Checker

Email Domain Blacklist Checker is PHP Library to check if a user is using a blacklisted domain name added by yourself.


## Getting Started
Email Domain Blacklist Checker is easy to use, you can just add the domain name without the extension that you would like to blacklist.
(Examples on data/blacklistDomains.json)

### Requires
[PHP 7.1+](https://secure.php.net/releases/)

```php
$file = 'src/data/blacklistDomains.json';
$classValidator = new Wodzy\EmailDomainBlacklistChecker\Validator();
$response = $classValidator->isBlacklisted($file, "john.doe@yopmail.com");

if ($response) {

    echo 'This domain is valid';
} else {

    echo 'This domain is not valid';
}
```

## ⚠️ Warning ⚠️
Email Domain Blacklist Checker can’t check if a email address is valid or not.

## Contributing 
This project is Open Source, don't hesitate to contribute or submit ideas.



## Author

* **Walid Oukaci** - [wodzy](https://github.com/wodzy)

## License

This project is licensed under the MIT License - see the [LICENSE.md](https://github.com/wodzy/EmailDomainBlacklistChecker/blob/master/LICENSE) file for details

