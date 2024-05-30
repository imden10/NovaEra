<!-- <pre><?php print_r($article) ?></pre> -->
<a href="<?= get_permalink($article->ID); ?>" class="article-preview">
    <div class="article-image" style="background: no-repeat center/cover url('<?= has_post_thumbnail($article->ID) ? get_the_post_thumbnail_url($article->ID, 'full') : ''; ?>');"></div>

    <div class="article-text">

        <h3 class="article-title"><?= $article->post_title; ?></h3>

        <p class="article-date"><?= $article->post_date ?></p>
       
        <p class="article-description"><?= $article->post_content; ?></p>
        <!-- <p class="article-description"><?= $article->post_excerpt; ?></p> -->
    </div>
</a>