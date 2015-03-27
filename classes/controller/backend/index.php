<?php

namespace Url;

class Controller_Backend_Index extends \Url\Controller_Backend
{

    /**
     * Create a short url
     */
    public function action_createshort()
    {
        // Get the long url, and create a random short url
        $url = \Input::get('url');
        $url = \LbUrl\Helper_Url::generate($url);

        $this->use_message and \Messages::success(__('url.your_short_url', array('url' => \LbUrl\Helper_Url::getUrl($url, true))));
        \Response::redirect_back(\Router::get('url_backend_url'));
    }

    /**
     * List all urls
     */
    public function action_index()
    {
        $id = $this->param('id');

        // Get all url (without master url)
    	$this->data['urls'] = $urls = \LbUrl\Helper_Url::getAllUrls();
        // Get the URL shortener widget
        $this->data['widget'] = \Request::forge('url/backend/index/widget', false)->execute();
        
        $this->theme->get_template()->set('pageTitle', __('url.title.manage_all'));
        $this->theme->set_partial('content', 'backend/index')->set($this->data, null, false);
    }    

    /**
     * Delete an url
     */
    public function action_delete()
    {
        $url = \LbUrl\Helper_Url::find($this->param('id'));
        if (\LbUrl\Helper_Url::delete($url))
        {
            $this->use_message and \Messages::success(__('url.message.deleted'));
        }
        else
        {
            $this->use_message and \Messages::error(__('url.error'));
        }

        \Response::redirect_back(\Router::get('url_backend_url'));
    }

    /**
     * Add or edit a url
     */
    public function action_add()
    {
        // Get id url
        $id = $this->param('id');

        // Set some data to view
        $this->data['isUpdate'] = $isUpdate = ($id !== null) ? true : false;
        
        // Forge Url fieldset
        $form = \Fieldset::forge('urlForm', array('form_attributes' => array('class' => 'form-horizontal')));
        $form->add_model('LbUrl\\Model_Url');
        $form->add('add', '', array('type' => 'submit', 'value' => ($isUpdate) ? __('url.edit')
                        : __('url.add'), 'class' => 'btn btn-primary'));

        // Get url object
        $this->data['url'] = $url = ($isUpdate) ? \LbUrl\Helper_Url::find($id) : \LbUrl\Helper_Url::forge();
        $form->populate($url);

        // Page title
        if ($isUpdate)
        {
            $this->theme->get_template()->set('pageTitle', __('url.title.edit_url', array('name' => $url->slug)));
        }
        else
        {
            $this->theme->get_template()->set('pageTitle', __('url.title.add_url'));
        }

        // Form process
        if (\Input::post('add'))
        {
            // validate the input
            $form->validation()->run();

            // if validated, create the object
            if (!$form->validation()->error())
            {
                // Set params for save the url
                $data = array(
                    'slug'        => $form->validated('slug'),
                    'url_target' => $form->validated('url_target'),
                    'code'        => $form->validated('code'),
                    'description' => $form->validated('description'),
                    'method'      => $form->validated('method'),
                    'active'      => $form->validated('active'),
                );
                $url->from_array($data);

                // Save
                $url = \LbUrl\Helper_Url::manage($url);
                if ($url)
                {
                    if ($isUpdate)
                        $this->use_message and \Messages::success(__('url.message.edited'));
                    else
                        $this->use_message and \Messages::success(__('url.message.added'));

                    \Response::redirect_back(\Router::get('url_backend_url'));
                }
                else
                {
                    $this->use_message and \Messages::error(__('url.error'));
                }
            }
            else
            {
                foreach ($form->validation()->error() as $error)
                {
                    $this->use_message and \Messages::error($error);
                }
            }
        }
        $form->repopulate();

        $this->data['form'] = $form;

        $this->theme->set_partial('content', 'backend/add')->set($this->data, null, false);
    }

    /**
     * REST API for url
     */
    public function action_api($context = '')
    {
        \Package::load('lbUrl');
        switch ($context)
        {
            /**
             * Toggle Activate Url
             */
            case 'toggle_url':
                $res = \LbUrl\Helper_Url::toggleActive(\Input::get('id'));
                return $this->response(array('success' => true));
            break;

            /**
             * Delete Url
             */
            case 'delete_url':
                $res = \LbUrl\Helper_Url::delete(\Input::get('id'));
                return $this->response(array('success' => true));
            break;

            /**
             * Get random slug
             */
            case 'get_random':
                $slug = \LbUrl\Helper_Url::randomSlug();
                return $this->response(array('success' => true, 'slug' => $slug));
        }
    }

    /**
     * Return the widget from HMVC
     * @return View
     */
    public function get_widget()
    {
        if (\Request::is_hmvc())
        {
            if (!\DBUtil::table_exists('url_url'))
            {
                $this->data['error'] = __('url.error_widget');
            }
            return \Theme::instance()->view('backend/widget')->set($this->data);
        }
    }

}