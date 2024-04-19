<?php
$formData = \App\Models\Form::getData($id);
?>

This is form

<pre>
    <?php
    print_r($formData);
    ?>
</pre>