<?php

namespace App\Components\MetaBox;

use App\Core\MetaBox\BaseMetaBox;

class Editor extends BaseMetaBox
{
    public function html()
    {
        echo '<div class="form-group">';
        echo '<label for="' . $this->name . '">' . $this->label . '</label>';
        echo '<textarea id="' . $this->name . '" class="form-control ck-editor" name="' . $this->name . '">' . $this->value . '</textarea>';
        echo '</div>';

        ?>

        <script type="text/javascript">
            $(document).ready(function() {
                $('.ck-editor').summernote(summernote_options);
            });
        </script>

    <?php
    }

    public static function beforeOutput($value)
    {
        return $value;
    }

    public static function beforeSave($value)
    {
        return $value;
    }
}