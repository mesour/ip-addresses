<?php

namespace Mesour\IpAddresses;

/**
 * @author Matouš Němec <mesour.com>
 */
abstract class IpAddressValidator
{

	final public static function isIpAddress(string $ipAddress): bool
	{
		return (bool) filter_var($ipAddress, FILTER_VALIDATE_IP);
	}

	final public static function isIpV4(string $ipAddress): bool
	{
		return (bool) filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4);
	}

	final public static function isIpV6(string $ipAddress): bool
	{
		return (bool) filter_var($ipAddress, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6);
	}

}
