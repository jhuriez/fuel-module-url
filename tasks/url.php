<?php

namespace Fuel\Tasks;

class Url
{
    public function install($publicPath = null, $theme = null)
    {
        \Lb\ModuleUtility::installAsset('url', dirname(__FILE__), $publicPath, $theme);
    }

    public function uninstall($publicPath = null, $theme = null)
    {
        \Lb\ModuleUtility::uninstallAsset('url', $publicPath, $theme);
    }
}