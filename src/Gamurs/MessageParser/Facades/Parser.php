<?php

namespace Gamurs\MessageParser\Facades;

use Illuminate\Support\Facades\Facade;

class Parser extends Facade
{
	/**
	 * Get the registered name of the component.
	 *
	 * @return string
	 */
	protected static function getFacadeAccessor()
	{
		return 'parser';
	}
}