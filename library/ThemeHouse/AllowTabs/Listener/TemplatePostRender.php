<?php

class ThemeHouse_AllowTabs_Listener_TemplatePostRender extends ThemeHouse_Listener_TemplatePostRender
{
    protected function _getTemplates()
    {
        return array(
            'PAGE_CONTAINER',
        );
    }

    public static function templatePostRender($templateName, &$content, array &$containerData, XenForo_Template_Abstract $template)
    {
        $templatePostRender = new ThemeHouse_AllowTabs_Listener_TemplatePostRender($templateName, $content, $containerData, $template);
        list($content, $containerData) = $templatePostRender->run();
    }

    protected function _pageContainer()
    {
        $jsExternals = $this->_template->getRequiredExternals('js');
        if ($jsExternals) {
            foreach ($jsExternals as $jsExternal) {
                if (preg_match('#bb_code_edit\.js#', $jsExternal)) {
                    $this->_template->addRequiredExternal('js', 'js/themehouse/allowtabs/bb_code_edit.js');
                }
            }
        }
    }
}