<?php
class ControllerShippingCustomShipping extends Controller {
    private $error; 
    
    public function index() {
        
        $this->language->load('shipping/customshipping');
        
        $this->load->model('setting/setting');
        $this->load->model('localisation/country');
        $this->load->model('localisation/tax_class');
        
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {
            $this->model_setting_setting->editSetting('customshipping', $this->request->post);
            	
            $this->session->data['success'] = $this->language->get('text_success');
        
            $this->redirect($this->url->link('shipping/customshipping', 'token=' . $this->session->data['token'], 'SSL'));
        }
        
        $this->document->setTitle($this->language->get('heading_title'));
        $this->data['heading_title']  = $this->language->get('heading_title');
        $this->data['text_enabled']   = $this->language->get('text_enabled');
        $this->data['text_disabled']  = $this->language->get('text_disabled');
        $this->data['text_none']      = $this->language->get('text_none');
        $this->data['entry_status']   = $this->language->get('entry_status');
        $this->data['entry_max_cost'] = $this->language->get('entry_max_cost');
        $this->data['entry_show_free']= $this->language->get('entry_show_free');
        $this->data['entry_sort_order'] = $this->language->get('entry_sort_order');
        $this->data['entry_zone'] = $this->language->get('entry_zone');
        $this->data['entry_country'] = $this->language->get('entry_country');
        $this->data['entry_country_text'] = $this->language->get('entry_country_text');
        $this->data['entry_first'] = $this->language->get('entry_first');
        $this->data['entry_next'] = $this->language->get('entry_next');
        $this->data['entry_tax_class'] = $this->language->get('entry_tax_class');
        $this->data['button_remove'] = $this->language->get('button_remove');
        $this->data['button_add_geo_zone'] = $this->language->get('button_add_geo_zone');
        $this->data['button_add'] = $this->language->get('button_add');
        $this->data['button_save'] = $this->language->get('button_save');
        $this->data['button_cancel'] = $this->language->get('button_cancel');
        
        $this->data['action'] = $this->url->link('shipping/customshipping', 'token=' . $this->session->data['token'], 'SSL');
        $this->data['cancel'] = $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL');
        
        $this->data['token'] = $this->session->data['token'];
        
        if (isset($this->error['warning'])) {
            $this->data['error_warning'] = $this->error['warning'];
        } else {
            $this->data['error_warning'] = '';
        }
        
        $this->data['countries'] = $this->model_localisation_country->getCountries();
        $this->data['tax_classes'] = $this->model_localisation_tax_class->getTaxClasses();
        
        $this->data['breadcrumbs'] = array();
        
        $this->data['breadcrumbs'][] = array(
                'text'      => $this->language->get('text_home'),
                'href'      => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
              	'separator' => false
        );
        
        $this->data['breadcrumbs'][] = array(
                'text'      => $this->language->get('text_shipping'),
                'href'      => $this->url->link('extension/shipping', 'token=' . $this->session->data['token'], 'SSL'),
              	'separator' => ' :: '
        );
        
        $this->data['breadcrumbs'][] = array(
                'text'      => $this->language->get('heading_title'),
                'href'      => $this->url->link('shipping/customshipping', 'token=' . $this->session->data['token'], 'SSL'),
              	'separator' => ' :: '
        );
        
        $postKeyArray = array('customshipping_status', 'customshipping_sort_order', 'customshipping_cost', 'customshipping_free_text','customshipping_max_cost');
        foreach($postKeyArray as $key)
        {
            if (isset($this->request->post['customshipping_status'])) {
                $this->data[$key] = $this->request->post[$key];
            } else {
                $this->data[$key] = $this->config->get($key);
            }
        }
        
        $this->children = array(
                'common/header',
                'common/footer'
        );
        $this->template = 'shipping/customshipping.tpl';
        
        $this->response->setOutput($this->render());
    }
    
    protected function validate() {
        if (!$this->user->hasPermission('modify', 'shipping/customshipping')) {
            $this->error['warning'] = $this->language->get('error_permission');
        }
    
        if (!$this->error) {
            return true;
        } else {
            return false;
        }
    }
}