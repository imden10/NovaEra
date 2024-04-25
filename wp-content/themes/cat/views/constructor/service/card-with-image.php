<?php
$data = array_diff_key($content, array_flip(['list']));
?>
<div class="container">
    <div class="wrapper">
        <pre>
            <?php
            print_r($data);
            ?>
        </pre>

        <pre>
            <?php
            print_r($content['list']);
            ?>
        </pre>
    </div>
</div>