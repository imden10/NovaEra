<!-- <pre> -->
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
<!-- </pre> -->
<?php if(isset($btns) && is_array($btns) && count($btns)):?>
<div class="btns-container">
    <?php foreach ($btns as $btn):?>
        <a href="<?= $btn['link'] ?>" class="btn <?= $btn['color'] ?> <?= $btn['size'] ?> <?= $btn['type']?> <?php if($btn['type_link'] == 'form'):?> render-form-btn <?php endif;?>"
        <?php if($btn['type_link'] == 'form'):?> data-form_id="<?= $btn['form_id'] ?>" <?php endif;?>
        >
            <?= $btn['text']?><i class="icon <?= $btn['icon']?>"></i>
        </a>
    <?php endforeach;?>
</div>
<?php endif;?>
