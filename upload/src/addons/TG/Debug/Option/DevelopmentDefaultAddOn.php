<?php

namespace TG\Debug\Option;

use XF\Option\AbstractOption;

class DevelopmentDefaultAddOn extends AbstractOption
{
	public static function renderOption(\XF\Entity\Option $option, array $htmlParams)
	{
        $addOns = self::getAddOnManager()->getInstalledAddOns();
        
        $choices = [
            '' => '',
            'XF' => 'XenForo'
        ];
        foreach ($addOns as $id => $addOn)
        {
            $choices[$id] = $addOn->title;
        }
        
        if (empty($choices[$option->option_value]))
        {
            $title = \XF::phrase('tgdebug_deleted', [
                'id' => $option->option_value
            ]);
            
            $choices[$option->option_value] = $title;
        }
        
		return self::getSelectRow($option, $htmlParams, $choices);
	}
    
	/**
	 * @return \XF\AddOn\Manager
	 */
	protected static function getAddOnManager()
	{
		return \XF::app()->addOnManager();
	}
}