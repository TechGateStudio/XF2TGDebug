<?php

namespace TG\Debug;

class Listener
{
	public static function appSetup(\XF\App $app)
	{
		$app->container()->extend('config', function($o, \XF\Container $c)
		{
			$options = \XF::options();
			
			if ($options->tgdebugDebugMode)
			{
				$o['debug'] = true;
			}

			if ($options->tgdebugDevelopmentMode)
			{
				$o['development']['enabled'] = true;
				$o['development']['defaultAddOn'] = $options->tgdebugDevelopmentDefaultAddOn;
			}
			
			return $o;
		});
		
		$app->checkDebugMode();
	}
	
	public static function appComplete(\XF\App $app, \XF\Http\Response &$response)
	{
		$visitor = \XF::visitor();

		if (!$visitor->canViewDebug())
		{
			$app->request()->set('_debug', 0);
		}
	}
}