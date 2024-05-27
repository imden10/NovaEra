<?php

namespace App\Controllers;

use App\Core\Controller\Controller;
use App\Response\ResponseTrait;
use App\Traits\TelegramBot;

class FormController
{
    use ResponseTrait;
    use TelegramBot;

    protected function templateName($object): string
    {
        return ($object instanceof \WP_Post && isset($object->page_template_name))
            ? '-' . strtolower($object->page_template_name)
            : '';
    }

    public function view($template, array $data = []): void
    {
        $viewsPath = app('path.views');

        $object = get_queried_object();

        $template = $viewsPath . DIRECTORY_SEPARATOR . $template .$this->templateName($object) . '.php';

        if (!is_file($template)) {
            throw new \Exception(sprintf('Template file %s not found', $template));
        }

        extract($data);
        status_header(200);
        require_once $template;

        die;
    }

    public function renderFormView($id)
    {
        $formData = \App\Models\Form::getData($id);

        $viewsPath = app('path.views');

        $object = get_queried_object();

        $data = [
            'id' => $id
        ];

        $template = $viewsPath . DIRECTORY_SEPARATOR . 'mod/_form' .$this->templateName($object) . '.php';
        extract($data);

        status_header(200);

        return [
            'html' => $template,
            'form_data' => $formData
        ];


//        $this->view('mod/_form', [
//            'id' => $id
//        ]);
    }

    /**
     * @return void
     */
    public function sendForm() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            try {
                $rawData = file_get_contents("php://input");
                $post = json_decode($rawData, true);

                if (!isset($post['form_id'])) {
                    return $this->errorResponse(['form_id - is required']);
                }

                $form = model('form')->find($post['form_id'])->post;

                if (!$form) return $this->errorResponse(['form - not found']);

                $groupsData = get_option('custom_form_settings');
                $group = null;

                foreach ($groupsData as $item) {
                    if ($item['form_id'] == $form->form_information_group_id) {
                        $group =  $item;
                    }
                }

                if (is_null($group)) return $this->errorResponse(['group - not found']);

                $message = "<b>" . $form->form_information_title . "</b>" . PHP_EOL;
                $fields = $form->form_information_fields;

                unset($post['form_id']);

                $nameItem = [];

                foreach ($fields as $field){
                    if (isset($field['content']['name'])) {
                        $nameItem[$field['content']['name']] = $field;
                    }
                }

                foreach ($post as $key => $field) {
                    if (isset($nameItem[$key]) && isset($nameItem[$key]['content']['show_in_message']) && $nameItem[$key]['content']['show_in_message'] == 1) {
                        $val = $field;

                        if ($nameItem[$key]['component'] == "FormCheckbox") {
                            if ($field == 1) {
                                $val = "Так";
                            } else {
                                $val = "Ні";
                            }
                        }

                        $mess = ($nameItem[$key]['content']['shown_name'] != '' ? ($nameItem[$key]['content']['shown_name'] . " - ") : '')  . $val . PHP_EOL;
                        $message .= $mess;
                    }
                }

                $flag = $this->sendMessage($message, $group);

                if (!isset($flag['ok']) || !$flag['ok']) {
                    return $this->errorResponse(['message' => 'Message failed']);
                }

                $res = [
                    'success_title' => $form->form_information_success_title,
                    'success_text'  => $form->form_information_success_text,
                ];

                return $this->successResponse($res);

            } catch (\Exception $e){
                die;
            }

            return $this->errorResponse(['message' => 'Error']);
        }
    }
}
