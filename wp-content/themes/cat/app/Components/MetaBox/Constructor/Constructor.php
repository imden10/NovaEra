<?php

namespace App\Components\MetaBox\Constructor;

use App\Core\MetaBox\BaseMetaBox;
use App\Models\Form;

class Constructor extends BaseMetaBox
{
    protected static $placeholder = '#listItemId';

    protected static $btn_placeholder = '#btnsElementId';
    protected static $btn_prefix = 'btns-item';

    public function html()
    {
        $label = $this->label ?? __('Конструктор сторінки');
        /* Scope section */
        echo '<h1>' . $label . '</h1>';
        echo '<div id="componentsScopes">';
        echo '<input type="hidden" name="component_placeholder" value="' . self::$placeholder . '">';

//        foreach ((array) $this->getFilesComponent() as $name)
//        {
//            if (isset($this->params['only']) && !in_array($name, $this->params['only'])) continue;
//
//            $object = $this->makeObject($name);
//
//            if ($object)
//            {
//                echo '<button type="button" class="clone-component" data="' . $this->objectWithoutNamespace($object) . '">' . $object->name . '</button>';
//                echo '<div style="display: none;">';
//                $object->handlerStyle();
//                $object->handlerScript();
//                $this->componentBody($object, self::$placeholder);
//                echo '</div>';
//            }
//        }

        foreach ($this->params['only'] as $name)
        {
            $object = $this->makeObject($name);

            if ($object)
            {
                echo '<button type="button" class="clone-component" data="' . $this->objectWithoutNamespace($object) . '">' . $object->name . '</button>';
                echo '<div style="display: none;">';
                $object->handlerStyle();
                $object->handlerScript();
                $this->componentBody($object, self::$placeholder);
                echo '</div>';
            }
        }

        echo '</div>';
        /* End Scope section */

        /* Output components section */
        echo '<div id="componentsContainer" class="components-container">';

        foreach ((array) $this->value as $key => $component)
        {
            if (isset($component['component']))
            {
                $object = $this->makeObject($component['component']);

                if ($object)
                {
                    $this->componentBody($object, $key, $component);
                }
            }
        }

        echo '</div>';
        /* End Output components section */
    }

    private function componentHeader($object, $key, $value)
    {
        $display = [
            'name' => $this->name . '[' . $key . '][display]',
            'value' => (!isset($value['display'])) ? ' checked' : ($value['display'] == 'on') ? ' checked' : ''
        ];
        $title = [
            'name' => $this->name . '[' . $key . '][content][title]',
            'value' => (isset($value['content']['title'])) ? $value['content']['title'] : ''
        ];
        ?>

        <div class="display-layout"></div>

        <!-- Confirm delete popup -->
        <div class="confirm-delete-component" style="display: none;">
            <h2><?php printf(__('Are you sure you want to delete the component %s?'), $object->name); ?></h2>
            <button class="confirm-action-button" type="button" data-confirm="confirm"><?php _e('Yes'); ?></button>
            <button class="confirm-action-button" type="button" data-confirm="cancel"><?php _e('Cancel'); ?></button>
        </div>
        <!-- End Confirm delete popup -->

        <div class="control-block">
            <div class="move-label">: : :</div>

            <div class="name-component">
                <?php echo $object->name; ?>
            </div>

            <div class="show-hide">
                <label class="checkbox">
                    <input type="hidden" name="<?php echo $display['name']; ?>" value="off">
                    <input type="checkbox" class="show-hide-checkbox" name="<?php echo $display['name']; ?>" value="on"<?php echo $display['value']; ?>>
                    <div class="checkbox__text"></div>
                </label>
            </div>

            <div class="delete">
                <button class="button delete-component-button"><?php _e('Delete'); ?></button>
            </div>

            <div class="slide-up">
                <span class="toggle-indicator"></span>
            </div>

            <?php if(isset($this->params['without_title']) && $this->params['without_title']):?>

            <?php else:?>
                <div class="title-block">
                    <input name="<?php echo $title['name']; ?>" placeholder="<?php _e('Title'); ?>" value="<?php echo $title['value']; ?>">
                </div>
            <?php endif;?>
        </div>

        <?php
    }

    private function componentFooter($object, $key, $value)
    {
        $component = [
            'name' => $this->name . '[' . $key . '][component]',
            'value' => $this->objectWithoutNamespace($object)
        ];
        $position = [
            'name' => $this->name . '[' . $key . '][position]',
            'value' => (isset($value['position']) && $value['position'] != '') ? $value['position'] : self::$placeholder
        ];

        $separatorList = [
            'M'   => 'M',
            'S'   => 'S',
            'L'   => 'L',
            'NON' => 'NON',
        ];

        $top_separator = [
            'name' => $this->name . '[' . $key . '][content][top_separator]',
            'value' => (isset($value['content']['top_separator'])) ? $value['content']['top_separator'] : 'M'
        ];

        $bottom_separator = [
            'name' => $this->name . '[' . $key . '][content][bottom_separator]',
            'value' => (isset($value['content']['bottom_separator'])) ? $value['content']['bottom_separator'] : 'M'
        ];

        $backgroundList = [
            'transparent' => 'Без фону',
            'white'       => 'Білий',
            'simple'      => 'Довільний колір',
        ];

        $background_type = [
            'name' => $this->name . '[' . $key . '][content][background_type]',
            'value' => (isset($value['content']['background_type'])) ? $value['content']['background_type'] : 'transparent'
        ];

        $background = [
            'name' => $this->name . '[' . $key . '][content][background]',
            'value' => (isset($value['content']['background'])) ? $value['content']['background'] : '#ffffff'
        ];

        // buttons
        $btns_list = [
            'name' => $this->name . '[' . $key . '][content][btns]',
            'value' => (isset($value['content']['btns']) && is_array($value['content']['btns'])) ? $value['content']['btns'] : []
        ];

        $formsList = Form::getList();

        ?>

        <?php if(isset($this->params['without_separator_block']) && $this->params['without_separator_block']):?>

        <?php else:?>
        <br>
        <hr>
        <div class="separator-block">
            <div class="row">
                <div class="col-3">
                    <label style="margin-bottom: 5px">Верхній роздільник</label>
                    <select name="<?php echo $top_separator['name']; ?>" class="form-control">
                        <?php foreach ($separatorList as $separatorListKey => $separatorListItem):?>
                            <option value="<?= $separatorListKey ?>" <?php if($separatorListKey == $top_separator['value']):?> selected <?php endif;?> ><?= $separatorListItem ?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="col-3">
                    <label style="margin-bottom: 5px">Нижній роздільник</label>
                    <select name="<?php echo $bottom_separator['name']; ?>" class="form-control">
                        <?php foreach ($separatorList as $separatorListKey => $separatorListItem):?>
                            <option value="<?= $separatorListKey ?>" <?php if($separatorListKey == $bottom_separator['value']):?> selected <?php endif;?> ><?= $separatorListItem ?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="col-3">
                    <label style="margin-bottom: 5px">Колір фону</label>
                    <select name="<?php echo $background_type['name']; ?>" class="form-control">
                        <?php foreach ($backgroundList as $backgroundListKey => $backgroundListItem):?>
                            <option value="<?= $backgroundListKey ?>" <?php if($backgroundListKey == $background_type['value']):?> selected <?php endif;?> ><?= $backgroundListItem ?></option>
                        <?php endforeach;?>
                    </select>
                </div>
                <div class="col-3">
                    <label style="margin-bottom: 5px">Довільний колір</label>
                    <input type="color" class="form-control" name="<?php echo $background['name']; ?>" value="<?php echo $background['value']; ?>">
                </div>
            </div>
        </div>
        <hr>
        <div class="btns-block">
            <template>
                <li data-item-id="<?php echo self::$placeholder; ?>_<?php echo self::$btn_placeholder; ?>" class="item-list-template">
                    <div class="card border-success">
                        <div class="card-body">
                            <div class="mb-3">
                                <input type="text" class="form-control form-control-sm"
                                       name="<?= $btns_list['name']; ?>[<?= self::$btn_placeholder; ?>][text]"
                                       placeholder="<?php _e('Текст '); ?>"
                                >
                            </div>
                            <div class="mb-3">
                                <select name="<?= $btns_list['name']; ?>[<?= self::$btn_placeholder; ?>][type_link]" class="form-control form-control-sm type_link">
                                    <option value="link">Довільне посилання</option>
                                    <option value="form">Форма</option>
                                </select>
                            </div>
                            <div class="mb-3 type_link_link">
                                <input type="text" class="form-control form-control-sm"
                                       name="<?= $btns_list['name']; ?>[<?= self::$btn_placeholder; ?>][link]"
                                       placeholder="<?php _e('Посилання '); ?>"
                                >
                            </div>
                            <div class="mb-3 type_link_form" style="display: none">
                                <select name="<?= $btns_list['name']; ?>[<?= self::$btn_placeholder; ?>][form_id]" class="form-control form-control-sm">
                                    <?php foreach($formsList as $formListKey => $formList):?>
                                        <option value="<?= $formListKey ?>"><?= $formList ?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <select name="<?= $btns_list['name']; ?>[<?= self::$btn_placeholder; ?>][type]" class="form-control form-control-sm">
                                    <?php foreach(config('buttons')['type'] as $listKey => $listItem):?>
                                        <option value="<?= $listKey ?>"><?= $listItem ?></option>
                                    <?php endforeach;?>
                                </select>
                            </div>
                            <div class="mb-3">
                                <?= do_shortcode('[icon_select name="' . esc_attr(base64_encode($btns_list['name'] ."[".self::$btn_placeholder."][icon]" )) . '"]'); ?>
                            </div>
                            <button type="button"
                                    class="btn btn-danger btn-sm float-end delete-list-element"><?php _e('Delete'); ?></button>
                        </div>
                    </div>
                </li>
            </template>

            <ul class="list-elements-container">
                <?php foreach ($btns_list['value'] as $id => $value) : ?>
                    <li data-item-id="<?php echo $id; ?>" class="item-list-template">
                        <div class="card border-success">
                            <div class="card-body">
                                <div class="mb-3">
                                    <input type="text" class="form-control form-control-sm"
                                           name="<?php echo $btns_list['name']; ?>[<?php echo $id; ?>][text]"
                                           value="<?= esc_attr($value['text']); ?>"
                                           placeholder="<?php _e('Текст '); ?>"
                                    >
                                </div>
                                <div class="mb-3">
                                    <?php $type_link = $value['type_link'] ?? ''; ?>
                                    <select name="<?php echo $btns_list['name']; ?>[<?php echo $id; ?>][type_link]" class="form-control form-control-sm type_link">
                                        <option value="link" <?php if($type_link == 'link') echo "selected"; ?> >Довільне посилання</option>
                                        <option value="form" <?php if($type_link == 'form') echo "selected"; ?> >Форма</option>
                                    </select>
                                </div>
                                <div class="mb-3 type_link_link" style="<?php if($type_link != 'link'):?> display: none <?php endif;?>">
                                    <input type="text" class="form-control form-control-sm"
                                           name="<?php echo $btns_list['name']; ?>[<?php echo $id; ?>][link]"
                                           placeholder="<?php _e('Посилання '); ?>"
                                           value="<?= esc_attr($value['link']); ?>"
                                    >
                                </div>
                                <?php $form_id = $value['form_id'] ?? ''; ?>
                                <div class="mb-3 type_link_form" style="<?php if($type_link != 'form'):?> display: none <?php endif;?>">
                                    <select name="<?php echo $btns_list['name']; ?>[<?php echo $id; ?>][form_id]" class="form-control form-control-sm">
                                        <?php foreach($formsList as $formListKey => $formList):?>
                                            <option value="<?= $formListKey ?>" <?php if($form_id == $formListKey) echo "selected"; ?> ><?= $formList ?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <?php $type = $value['type'] ?? ''; ?>
                                    <select name="<?php echo $btns_list['name']; ?>[<?php echo $id; ?>][type]" class="form-control form-control-sm">
                                        <?php foreach(config('buttons')['type'] as $listKey => $listItem):?>
                                            <option value="<?= $listKey ?>" <?php if($type == $listKey) echo "selected"; ?> ><?= $listItem ?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <?= do_shortcode('[icon_select ready="true" icon="'.$value['icon'].'" name="' . esc_attr(base64_encode($btns_list['name'] ."[".$id."][icon]" )) . '"]'); ?>
                                </div>
                                <button type="button" class="btn btn-danger btn-sm float-end delete-list-element"><?php _e('Delete'); ?></button>
                            </div>
                        </div>
                    </li>
                <?php endforeach; ?>
            </ul>

            <button type="button"
                    data-id="<?= $key ?>"
                    data-placeholder="<?= self::$btn_placeholder ?>"
                    class="btn btn-success btn-sm add-button-component"
            ><?php _e('Додати кнопку'); ?></button>
        </div>
        <?php endif;?>

        <div class="footer-block">
            <input type="hidden" name="<?php echo $component['name']; ?>" value="<?php echo $component['value']; ?>">
            <input type="hidden" name="<?php echo $position['name']; ?>" value="<?php echo $position['value']; ?>" class="position-component">
        </div>

        <?php
    }

    private function componentBody($object, $key, $value = null)
    {
        $component = $this->objectWithoutNamespace($object);

        echo '<div id="component-' . $key . '" class="' . $component . ' component-container" data-component-id="' . $key . '">';
        $this->componentHeader($object, $key, $value);
        $object->html($key, $this->name, $value);
        $this->componentFooter($object, $key, $value);
        echo '</div>';
    }

    private function getFilesComponent()
    {
        $dir = dirname(__FILE__) . DIRECTORY_SEPARATOR . 'components';

        if (!is_dir($dir)) return false;

        $files = scandir($dir);

        if (!$files || !is_array($files)) return false;

        $result = [];

        foreach ($files as $file)
        {
            if ($file == '.' || $file == '..' || is_dir($file)) continue;

            $result[] = $file;
        }

        return $result;
    }

    private function makeObject($name)
    {
        $objectName = __NAMESPACE__ . '\\components\\' . pathinfo($name)['filename'];

        if (class_exists($objectName))
        {
            return new $objectName();
        }

        return null;
    }

    private function objectWithoutNamespace($object)
    {
        $parts = explode('\\', get_class($object));

        return end($parts);
    }

    public static function beforeOutput($value)
    {
        return $value;
    }

    public static function beforeSave($value)
    {
        if (isset($value[self::$placeholder])) unset($value[self::$placeholder]);

        return $value;
    }
}