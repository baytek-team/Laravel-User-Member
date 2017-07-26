<?php

namespace Baytek\Laravel\Users\Members\Roles;

use Baytek\Laravel\Users\User;
use Baytek\Laravel\Users\Roles\Role;

class Member extends Role
{
	const ROLE = 'Member';

	public $redirectTo = [
		'url' => '/app'
	];

	public function __construct(User $user)
	{
		parent::__construct($user);
	}
}