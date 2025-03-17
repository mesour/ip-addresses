<?php

declare(strict_types = 1);

namespace MesourTests\IpAddressesTests;

use Mesour\IpAddresses\IpAddress;
use Mesour\IpAddresses\IpAddressIsInvalidException;
use PHPUnit\Framework\TestCase;

final class IpAddressTest extends TestCase
{

	public function testIpCheckAndValue(): void
	{
		$ipAddress = IpAddress::create('0000:0db8:0800:0000:0000:ff00:0042:8329');
		self::assertFalse($ipAddress->isIpV4());
		self::assertTrue($ipAddress->isIpV6());
		self::assertSame('0:db8:800::ff00:42:8329', $ipAddress->getValue());

		$ipAddress = IpAddress::create('0:db8:800::ff00:42:8329');
		self::assertFalse($ipAddress->isIpV4());
		self::assertTrue($ipAddress->isIpV6());
		self::assertSame('0:db8:800::ff00:42:8329', $ipAddress->getValue());

		$ipAddress = IpAddress::create('127.0.0.1');
		self::assertTrue($ipAddress->isIpV4());
		self::assertFalse($ipAddress->isIpV6());
		self::assertSame('127.0.0.1', $ipAddress->getValue());
	}

	public function testInvalidIp(): void
	{
		self::expectException(IpAddressIsInvalidException::class);

		IpAddress::create('123');
	}

}
