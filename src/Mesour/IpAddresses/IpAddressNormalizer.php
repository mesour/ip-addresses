<?php

declare(strict_types = 1);

namespace Mesour\IpAddresses;

/** @author Matouš Němec <mesour.com> */
abstract class IpAddressNormalizer
{

	final public static function normalizeIpV6(string $address): string
	{
		if (\strpos($address, '::') !== false) {
			$part = \explode('::', $address);
			$part[0] = \explode(':', $part[0]);
			$part[1] = \explode(':', $part[1]);
			$missing = [];

			for ($i = 0; $i < 8 - (\count($part[0]) + \count($part[1])); $i++) {
				\array_push($missing, '0000');
			}

			$missing = \array_merge($part[0], $missing);
			$part = \array_merge($missing, $part[1]);
		} else {
			$part = \explode(':', $address);
		}

		foreach ($part as &$p) {
			while (\strlen($p) < 4) {
				$p = '0' . $p;
			}
		}

		unset($p);

		$result = \implode(':', $part);

		if (\strlen($result) === 39) {
			return $result;
		}

		throw new \UnexpectedValueException('Ip address is not valid.');
	}

	final public static function compressIpV6(string $ip): string
	{
		if (\substr($ip, 0, 4) === '0000') {
			$ip = \substr_replace($ip, ':0', 0, 4);
		}

		$ip = \str_replace(':0000', ':0', $ip);
		$ip = \preg_replace('/:0{1,3}(?=\w)/', ':', $ip);
		$z = ':0:0:0:0:0:0:0:';

		while (\strpos($ip, '::') === false && \strlen($z) >= 5) {
			$pos = \strpos($ip, $z);

			if ($pos !== false) {
				$ip = \substr_replace($ip, '::', $pos, \strlen($z));

				break;
			}

			$z = \substr($z, 0, \strlen($z) - 2);
		}

		if (\substr($ip, 1, 1) !== ':') {
			return \ltrim($ip, ':');
		}

		return $ip;
	}

}
