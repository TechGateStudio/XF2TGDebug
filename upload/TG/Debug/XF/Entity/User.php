<?php

namespace TG\Debug\XF\Entity;

class User extends XFCP_User
{
	public function canViewDebug()
	{
		return $this->hasPermission('tgdebug', 'viewDebug');
	}
}