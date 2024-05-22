<?php
$formData = \App\Models\Form::getData($id);
?>

This is form <?= $id ?>

<pre>
    <?php
    print_r($formData);
    ?>
</pre>