<?php

class ThemeHouse_AllowTabs_Listener_LoadClass extends ThemeHouse_Listener_LoadClass
{
    protected function _getExtendedClasses()
    {
        return array(
            'ThemeHouse_AllowTabs' => array(
                'controller_helper' => array(
                    'XenForo_ControllerHelper_Editor',
                ), 
                'bb_code' => array(
                    'XenForo_BbCode_Formatter_Wysiwyg',
                ), 
            ), 
        );
    }

    public static function loadClassControllerHelper($class, array &$extend)
    {
        $loadClassControllerHelper = new ThemeHouse_AllowTabs_Listener_LoadClass($class, $extend, 'controller_helper');
        $extend = $loadClassControllerHelper->run();
    }

    public static function loadClassBbCode($class, array &$extend)
    {
        $loadClassBbCode = new ThemeHouse_AllowTabs_Listener_LoadClass($class, $extend, 'bb_code');
        $extend = $loadClassBbCode->run();
    }
}