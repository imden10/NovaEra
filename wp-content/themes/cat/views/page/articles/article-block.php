<a href="<?= get_permalink($article->ID); ?>" class="article-preview">

    <img class="article-image" src="<?= get_the_post_thumbnail_url($article->ID, 'full'); ?>" alt="">

    <div class="article-text">

        <h3 class="article-title"><?= $article->post_title; ?></h3>

        <p class="article-date"><?= $article->post_date ?></p>
       
        <p class="article-description"><?= $article->post_content; ?></p>
        <!-- <p class="article-description"><?= $article->post_excerpt; ?></p> -->
    </div>
</a>