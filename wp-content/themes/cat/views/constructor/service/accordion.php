<?php
$data = array_diff_key($content, array_flip(['list', 'image']));
$imageUrl = get_image_url_by_id($content['image']['id']);
?>

<div class="column60">
    <div class="container">
        <?php
        print_r($data);
        ?>
        <!-- <img src="<?= $imageUrl ?>" alt="" style="width: 200px"> -->

        <!-- hasMiniText -->
        <div class="block-wrapper <?= $content['content_position'] ?>">
            <!-- <div class="mini-text">
                <div class="redactor">
                    <h1>Lorem, ipsum.</h1>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
                </div>
            </div> -->
            <div class="accordion-wrapper">
                <?php if (!empty($content['title'])) : ?>
                    <h2><?php echo $content['title']; ?></h2>
                <?php endif; ?>

                <?php if (!empty($content['text'])) : ?>
                    <h2><?php echo $content['text']; ?></h2>
                <?php endif; ?>

                <?php if (isset($content['list'])) : ?>
                    <?php foreach ($content['list'] as $item) : ?>
                        <div onclick="slideToggle(this)" class="accordion-title">
                            <?= $item['title']; ?>
                            <span class="icon"></span>
                        </div>
                        <div class="accordion-content redactor" hidden>
                            <?= $item['description']; ?>
                        </div>

                        <!-- new fields -->
                        <img src="<?= get_image_url_by_id($item['image']); ?>" alt="" style="max-width: 200px">

                        <?php if($item['btn__enable'] == 1): ?>
                            <?php
                            if($item['btn__type_link'] === "form"){
                                $formData = \App\Models\Form::getData($item['btn__form_id']);
                            }

                            print_r($item);
                            print_r($formData);
                            ?>

                            <button><?= $item['btn__text'] ?></button>
                        <?php endif; ?>

                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>
</div>

<?php require app('path.views') . '/constructor/_buttons.php'; ?>