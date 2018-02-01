# Mesour IP addresses

- [Author](http://mesour.com)

- IP address normalizer and validator. For IPv4 and IPv6.

# Install

- With [Composer](https://getcomposer.org)

        composer require mesour/ip-addresses

- Or download source from [GitHub](https://github.com/mesour/ip-addresses/releases)

# Usage

- **In `AaaaDnsRecord` is IPv6 compressed to short format.**

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

# Tests

- Run tests: `bin/check-tests`
- PHP Stan: `bin/check-stan`
- Code style: `bin/check-cs`
