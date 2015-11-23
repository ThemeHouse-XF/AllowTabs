<?php

class ThemeHouse_AllowTabs_Extend_XenForo_ControllerHelper_Editor extends XFCP_ThemeHouse_AllowTabs_Extend_XenForo_ControllerHelper_Editor
{

    public function convertEditorHtmlToBbCode($messageTextHtml, XenForo_Input $input, $htmlCharacterLimit = -1)
    {
        $messageTextHtml = str_replace("\t", '[TAB]', $messageTextHtml);

        $rendered = parent::convertEditorHtmlToBbCode($messageTextHtml, $input, $htmlCharacterLimit);

        $rendered = str_replace('[TAB]', "\t", $rendered);

        return $rendered;
    }
}