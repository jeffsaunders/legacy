<?php class ControllerModuleReferafriend extends Controller {
        private $error = array();

        public function index() {
                $this->language->load('module/referafriend');
                $this->document->setTitle($this->language->get('heading_title'));

                $this->load->model('setting/setting');

                if (($this->request->server['REQUEST_METHOD'] == 'POST')) {
                        $this->model_setting_setting->editSetting('referafriend', $this->request->post);

                        $this->session->data['success'] = $this->language->get('text_success');

                        $this->redirect($this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'));
                }

                $this->data['heading_title'] = $this->language->get('heading_title');
				$this->data['code'] = html_entity_decode($this->config->get('referafriend_code'));
                $this->data['referafriend_code'] = $this->language->get('referafriend_code');
                $this->data['button_save'] = $this->language->get('button_save');
                $this->data['button_cancel'] = $this->language->get('button_cancel');
                $this->data['button_add_module'] = $this->language->get('button_add_module');
                $this->data['button_remove'] = $this->language->get('button_remove');
                $this->data['breadcrumbs'] = array();
                $this->data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_home'),
                        'href' => $this->url->link('common/home', 'token=' . $this->session->data['token'], 'SSL'),
                'separator' => false
                );
                $this->data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_module'),
                        'href' => $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL'),
                'separator' => ' :: '
                );

                $this->data['action'] = $this->url->link('module/referafriend', 'token=' . $this->session->data['token'], 'SSL');

                $this->data['cancel'] = $this->url->link('extension/module', 'token=' . $this->session->data['token'], 'SSL');
				                if (isset($this->request->post['referafriend_code'])) {
                        $this->data['referafriend_code'] = $this->request->post['referafriend_code'];
                }

                $this->template = 'module/referafriend.tpl';
                $this->children = array(
                        'common/header',
                        'common/footer'
                );

                $this->response->setOutput($this->render());
         }
        }
?>
