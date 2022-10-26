<?php

declare(strict_types = 1);

namespace Mesour\IpAddressesTests;

use Mesour\IpAddresses\IpAddress;
use Mesour\IpAddresses\IpAddressIsInvalidException;
use Tester\Assert;

require_once __DIR__ . '/../../bootstrap.php';
require_once __DIR__ . '/BaseTestCase.php';

/**
 * @testCase
 */
final class IpAddressTest extends BaseTestCase
{

	public function testIpCheckAndValue(): void
	{
		$ipAddress = IpAddress::create('0000:0db8:0800:0000:0000:ff00:0042:8329');
		Assert::false($ipAddress->isIpV4());
		Assert::true($ipAddress->isIpV6());
		Assert::same('0:db8:800::ff00:42:8329', $ipAddress->getValue());

		$ipAddress = IpAddress::create('0:db8:800::ff00:42:8329');
		Assert::false($ipAddress->isIpV4());
		Assert::true($ipAddress->isIpV6());
		Assert::same('0:db8:800::ff00:42:8329', $ipAddress->getValue());

		$ipAddress = IpAddress::create('127.0.0.1');
		Assert::true($ipAddress->isIpV4());
		Assert::false($ipAddress->isIpV6());
		Assert::same('127.0.0.1', $ipAddress->getValue());
	}

	public function testInvalidIp(): void
	{
		Assert::exception(function (): void {
			IpAddress::create('123');
		}, IpAddressIsInvalidException::class);
	}

}

$test = new IpAddressTest();
$test->run();
