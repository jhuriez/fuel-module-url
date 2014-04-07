<?php

namespace Url;

class Controller_Backend extends \Controller_Base_Backend
{
    public $module = 'url';
    public $dataGlobal = array();

    public function before() {
        if (\Input::is_ajax())
        {
            return parent::before();
        }
        else
        {
            parent::before();
        }
        // Load package
        \Package::load('lbUrl');

        // Load Config
        \Config::load('url', true);
        
        // Load language
        \Lang::load('url', true);

        // Message class exist ?
        $this->use_message = class_exists('\Messages');

        // Use Casset ?
        $this->use_casset = \Config::get('url.module.use_casset');

        // Set Media
        $this->setModuleMedia();
    }

    public function setModuleMedia()
    {
        if ($this->use_casset)
        {
            $activeTheme = $this->theme->active();
            \Casset::add_path('theme', $activeTheme['asset_base']);
        }

        // Jquery
        if (\Config::get('url.module.force_jquery'))
        {
            $this->addAsset(array(
                'modules/' . $this->module . '/jquery.min.js',
                'modules/' . $this->module . '/jquery-ui.min.js',
            ), 'js', 'js_core');
        }

        // Bootstrap
        if (\Config::get('url.module.force_bootstrap'))
        {
            $this->addAsset(array(
                'modules/' . $this->module . '/bootstrap/css/bootstrap.css',
                'modules/' . $this->module . '/bootstrap/css/bootstrap-glyphicons.css',
            ), 'css', 'css_plugin');

            $this->addAsset(array(
                'modules/' . $this->module . '/bootstrap.js',
            ), 'js', 'js_core');
        }

        // Fontawesome
        if (\Config::get('url.module.force_font-awesome'))
        {
            $this->addAsset(array(
                'modules/' . $this->module . '/font-awesome/css/font-awesome.css',
            ), 'css', 'css_plugin');
        }
    }

    public function addAsset($files, $type, $group, $attr = array(), $raw = false)
    {
        $group = (\Config::get('url.module.assets.'.$group) ? : $group);

        if ($this->use_casset)
        {
            foreach((array)$files as $file)
                \Casset::{$type}('theme::'.$file, false, $group);
        }
        else
        {
            $this->theme->asset->{$type}($files, $attr, $group, $raw);
        }
    }
}