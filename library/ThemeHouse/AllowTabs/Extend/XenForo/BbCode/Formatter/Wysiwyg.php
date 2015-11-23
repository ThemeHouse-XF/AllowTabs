<?php

/**
 *
 * @see XenForo_BbCode_Formatter_Wysiwyg
 */
class ThemeHouse_AllowTabs_Extend_XenForo_BbCode_Formatter_Wysiwyg extends XFCP_ThemeHouse_AllowTabs_Extend_XenForo_BbCode_Formatter_Wysiwyg
{

    /**
     *
     * @see XenForo_BbCode_Formatter_Wysiwyg::filterString()
     */
    public function filterString($string, array $rendererStates)
    {
        $string = strtr($string, array(
            "\t" => "[tab][/tab]"
        ));

        $string = parent::filterString($string, $rendererStates);

        $string = strtr($string, array(
            '[tab][/tab]' => "<span style=\"white-space: pre;\">\t</span>"
        ));

        return $string;
    }
}