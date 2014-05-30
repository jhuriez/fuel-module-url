# Fuel LbUrl Module

This module is used to manage the Lb Fuel Url Package
You can install the Fuel LbUrl package here : [Click here](https://github.com/jhuriez/fuel-lbUrl-package)

You may have bugs on this module, it's not completely finished. Furthermore, it's difficult to automatically adapted a module on an existing project.
This module can  be used as a basis to create your own section to manage the Fuel LbUrl Package.

# Features

* Manage all short urls easily
* Translation
* Easy integration in your Theme
* Use jQuery and Bootstrap 3

# Installation

1. This module uses Theme class, you must create your theme folder.
2. You need to install the Lb Package : [See more](http://github.com/jhuriez/fuel-lb-package)
3. Clone or download the fuel-module-url repository
4. Move it into your module folder, and rename it to "url"
5. Open your oil console
6. Run `oil refine url::url:install [your_public_folder] [your_theme]` to generate needed files (copy js and css files in assets folder). 
* [your_public_folder] is optionnally if your public folder is not named "public"
* [your_theme] is if you use a theme other than the default theme

# Configuration

## Base controller

This module is not securised, i've not added a ACL or Auth security. You need to attach this module on your base admin controller :

In `modules/url/classes/controller/backend.php` at line 5 :

```php
  class Controller_Backend extends \Controller_Base_Backend
```

You can see an example of a simple controller using theme here : [`url/example/simple_controller.php`](https://github.com/jhuriez/fuel-lb-package/blob/master/example/simple_controller.php)

## Theme

It uses the Theme class from FuelPHP, consequently you need to have a theme for your administration.

You need to load jQuery and jQuery UI, and optionnaly Twitter Bootstrap v3 + Font Awesome
For this, see the docs in Lb Package wiki : [Here](http://github.com/jhuriez/fuel-lb-package/blob/master/wiki/theme.md)

## Implementation

All variables used in the template file from theme :

* $pageTitle : For the title of the page in any action
* $partials['content'] : The partial for the content
* `<?= \Theme::instance()->asset->render('css_plugin'); ?>` in the head
* `<?= \Theme::instance()->asset->render('js_core'); ?>` in the head
* `<?= \Theme::instance()->asset->render('js_plugin'); ?>` in the footer

You can see an example of template here : [`menu/example/template.php`](http://github.com/jhuriez/fuel-lb-package/blob/master/example/template.php)

## Widget

You can use the widget "URL shortener" wherever on your project :

```php
\Request::forge('url/backend/index/widget', false)->execute();
```

# Usage

Access the backoffice at : http://your-fuel-url/url/backend

# Error

- Fuel\Core\ThemeException [ Error ]: Theme "default" could not be found.
It's because this module uses Themes for better flexibility. You must create a theme folder, by default it's DOCROOT/themes/default.

- ErrorException [ Fatal Error ]: Class '\Backend\Controller_Backend' not found.
It's because the controller \Url\Controller_Backend need to extends your admin controller in your project. In my case, the admin controller is named \Backend\Controller_Backend

# Override Theme

Views module use Twitter bootstrap 3 tags for the UI. And FontAwesome

You can override them easily. For example for override the view 'url/views/backend/index.php', you need to create the same file here "DOCROOT/themes/[your_theme]/url/backend/index.php"

# Screenshots

1. [Manage urls](http://i.imgur.com/Gm9FsQj.png)
2. [Edit url](http://i.imgur.com/YPKk924.png)
