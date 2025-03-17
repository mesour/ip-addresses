<?php

declare(strict_types = 1);

namespace Mesour\IpAddresses;

/** @author Matouš Němec <mesour.com> */
final class IpAddress
{

	private function __construct(private string $ipAddress, private bool $ipV4)
	{
	}

	public static function create(string $ipAddress): self
	{
		if (IpAddressValidator::isIpV4($ipAddress)) {
			return new self($ipAddress, true);
		}

        if (IpAddressValidator::isIpV6($ipAddress)) {
			return new self(IpAddressNormalizer::compressIpV6($ipAddress), false);
		}

        throw new IpAddressIsInvalidException();
	}

	public function isIpV4(): bool
	{
		return $this->ipV4;
	}

	public function isIpV6(): bool
	{
		return !$this->isIpV4();
	}

	public function getValue(): string
	{
		return $this->ipAddress;
	}

}
