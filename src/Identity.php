<?php declare(strict_types = 1);

namespace Mangoweb\Authorization;


interface Identity
{

	public function getRoles(): array;

}
