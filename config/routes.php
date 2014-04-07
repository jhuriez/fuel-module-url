<?php


return array(
	'_root_'                     => '/url/backend/404',
	'_404_'                      => '/url/backend/404',
	'backend'                    => array('url/backend/index', 'name' => 'url_backend_url'),                          
	'backend/add'                => array('url/backend/index/add', 'name' => 'url_backend_add'),                    
	'backend/add/:id'            => array('url/backend/index/add', 'name' => 'url_backend_edit'),                  
	'backend/delete/:id'         => array('url/backend/index/delete', 'name' => 'url_backend_delete'),
	'backend/url_create'		 => array('url/backend/index/createshort', 'name' => 'url_create_short'),
);