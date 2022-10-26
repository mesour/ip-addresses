# Mesour IP addresses

- [Author](http://mesour.com)

- IP address normalizer and validator. For IPv4 and IPv6.

# Install

- With [Composer](https://getcomposer.org)

        composer require mesour/ip-addresses

- Or download source from [GitHub](https://github.com/mesour/ip-addresses/releases)

# Usage

### Usage: `Mesour\IpAddresses\IpAddressValidator`

```php
Assert::true(IpAddressValidator::isIpV6('2a00:5565:2222:800::200e'));

Assert::true(IpAddressValidator::isIpV4('127.0.0.1'));
```

### Usage: `Mesour\IpAddresses\IpAddressNormalizer`

Normalize IPv6:
```php
IpAddressNormalizer::normalizeIpV6('2001:db8:800::ff00:42:8329');

// result is: 2001:0db8:0800:0000:0000:ff00:0042:8329
```

Compress IPv6:
```php
IpAddressNormalizer::compressIpV6('2001:0db8:0800:0000:0000:ff00:0042:8329');

// result is: 2001:db8:800::ff00:42:8329
```

### Usage: `Mesour\IpAddresses\IpAddress`

Normalize IPv4:
```php
$ipAddress = IpAddress::create('127.0.0.1');

$ipAddress->isIpV4(); // result is: true
$ipAddress->isIpV6(); // result is: false
$ipAddress->getValue(); // result is: 127.0.0.1
```

Normalize IPv6:

- Result of `getValue` is compressed IPv6 value

```php
$ipAddress = IpAddress::create('2001:0db8:0800:0000:0000:ff00:0042:8329');

$ipAddress->isIpV4(); // result is: false
$ipAddress->isIpV6(); // result is: true
$ipAddress->getValue(); // result is: 2001:db8:800::ff00:42:8329
```

# Development

- Syntax check: `vendor/bin/parallel-lint src tests`
- PHP Stan: `vendor/bin/phpstan analyse -l 7 -c phpstan.neon src tests`
- Run tests: `vendor/bin/tester -p php tests/ -s -c tests/php.ini`
