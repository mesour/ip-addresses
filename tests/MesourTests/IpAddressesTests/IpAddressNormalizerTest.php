<?php

declare(strict_types = 1);

namespace MesourTests\IpAddressesTests;

use Mesour\IpAddresses\IpAddressNormalizer;
use PHPUnit\Framework\TestCase;

final class IpAddressNormalizerTest extends TestCase
{

	public function testCompress(): void
	{
		self::assertSame(
			'2001:db8::ff00:42:8329',
			IpAddressNormalizer::compressIpV6('2001:0db8:0000:0000:0000:ff00:0042:8329')
		);

		self::assertSame(
			'2001:db8:800::ff00:42:8329',
			IpAddressNormalizer::compressIpV6('2001:0db8:0800:0000:0000:ff00:0042:8329')
		);

		self::assertSame(
			'0:db8:800::ff00:42:8329',
			IpAddressNormalizer::compressIpV6('0000:0db8:0800:0000:0000:ff00:0042:8329')
		);

		self::assertSame(
			'f000:db8:800::ff00:42:0',
			IpAddressNormalizer::compressIpV6('f000:0db8:0800:0000:0000:ff00:0042:0000')
		);
	}

	public function testNormalize(): void
	{
		self::assertSame(
			'2001:0db8:0000:0000:0000:ff00:0042:8329',
			IpAddressNormalizer::normalizeIpV6('2001:db8::ff00:42:8329')
		);

		self::assertSame(
			'2001:0db8:0800:0000:0000:ff00:0042:8329',
			IpAddressNormalizer::normalizeIpV6('2001:db8:800::ff00:42:8329')
		);

		self::assertSame(
			'0000:0db8:0800:0000:0000:ff00:0042:8329',
			IpAddressNormalizer::normalizeIpV6('0:db8:800::ff00:42:8329')
		);

		self::assertSame(
			'f000:0db8:0800:0000:0000:ff00:0042:0000',
			IpAddressNormalizer::normalizeIpV6('f000:db8:800::ff00:42:0')
		);
	}

}
