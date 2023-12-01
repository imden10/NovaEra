<?php

namespace App\Controllers;

use App\Response\ResponseTrait;
use App\Traits\TelegramBot;

class FormController
{
    use ResponseTrait;
    use TelegramBot;

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
