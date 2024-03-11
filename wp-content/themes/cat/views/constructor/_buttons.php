<pre>
    <?php
    $btns = [];

    if(isset($content['btns']) && is_array($content['btns']) && count($content['btns'])){
        foreach ($content['btns'] as $btnKey => $btnItem){
            $btns[$btnKey] = $btnItem;
            if($btnItem['type_link'] == 'form'){
                $btns[$btnKey]['form_data'] = \App\Models\Form::getData($btnItem['form_id']);
            }
        }
    }
    ?>
</pre>
<?php if(isset($btns) && is_array($btns) && count($btns)):?>
<div class="btns-container">
    <?php foreach ($btns as $btn):?>
        <div class="btn <?= $btn['type']?>"><?= $btn['text']?> <i class="<?= $btn['icon']?>"></i></div>
    <?php endforeach;?>
</div>
<?php endif;?>
