<?php
    $data = array_diff_key($content,array_flip(['list']));
?>

<div class="constr">
    <div class="container mobfluid">
        <h3>Етапи</h3>
        <pre>
            <?php
                print_r($data);
            ?>
        </pre>
        <div class="constrlistwrap">
            <div class="headerwrap">
                <?php if (!empty($content['title'])) : ?>
                    <h2><?php echo $content['title']; ?></h2>
                <?php endif; ?>
            </div>

            <?php if (isset($content['list'])) : ?>
                <ul class="constlist">
                    <?php foreach ($content['list'] as $item) : ?>
                        <li>
                            <h4><?= $item['title']; ?></h4>
                            <p><?= $item['description']; ?></p>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
</div>
