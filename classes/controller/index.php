<?php

namespace Url;

class Controller_Index extends \Controller
{

	// Redirect URL
	public function action_index()
	{
		$slug = $this->param('slug');

		\Package::load('lbUrl');

		if (\LbUrl\Helper_Url::redirect($slug) === false)
			throw new \HttpNotFoundException;
	}
}