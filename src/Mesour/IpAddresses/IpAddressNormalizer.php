<?php

declare(strict_types = 1);

namespace Mesour\IpAddresses;

use UnexpectedValueException;

/** @author Matouš Němec <mesour.com> */
abstract class IpAddressNormalizer
{

	/** @throws \UnexpectedValueException */
	final public static function normalizeIpV6(string $address): string
	{
		if (\str_contains($address, '::')) {
			$parts = $part = \explode('::', $address);
			$parts[0] = \explode(':', $part[0]);
			$parts[1] = \explode(':', $part[1]);
			$missing = [];

			for ($i = 0; $i < 8 - (\count($parts[0]) + \count($parts[1])); $i++) {
				$missing[] = '0000';
			}

			$missing = \array_merge($parts[0], $missing);
			$parts = \array_merge($missing, $parts[1]);
		} else {
			$parts = \explode(':', $address);
		}

		foreach ($parts as &$p) {
			while (\strlen($p) < 4) {
				$p = '0' . $p;
			}
		}

		unset($p);

		$result = \implode(':', $parts);

		if (\strlen($result) === 39) {
			return $result;
		}

		throw new UnexpectedValueException('Ip address is not valid.');
	}

	/** @throws \UnexpectedValueException */
	final public static function compressIpV6(string $ip): string
	{
		if (\str_starts_with($ip, '0000')) {
			$ip = \substr_replace($ip, ':0', 0, 4);
		}

		$ip = \str_replace(':0000', ':0', $ip);
		$ip = \preg_replace('/:0{1,3}(?=\w)/', ':', $ip);

		if ($ip === null) {
			throw new \LogicException('Ip address is not valid.');
		}

		$z = ':0:0:0:0:0:0:0:';

		while (!\str_contains($ip, '::') && \strlen($z) >= 5) {
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
