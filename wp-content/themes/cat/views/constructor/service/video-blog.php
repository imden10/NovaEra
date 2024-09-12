<?php
$data = array_diff_key($content, array_flip(['file']));
$fileUrl = get_image_url_by_id($content['file']['id']);

if ($data['type'] == 'link') {
    function youtubeEmbedUrl($url)
    {
        // Разбор URL
        $parsedUrl = parse_url($url);

        // Обработка сокращенных ссылок (youtu.be)
        if ($parsedUrl['host'] === 'youtu.be') {
            // Получаем идентификатор видео из пути URL
            $videoId = ltrim($parsedUrl['path'], '/');
            return "https://www.youtube.com/embed/" . $videoId . "?autoplay=1";
        }

        // Обработка ссылок на видео с использованием `watch?v=`
        if (strpos($url, 'watch?v=') !== false) {
            // Извлекаем идентификатор видео (все, что идет после "watch?v=")
            parse_str($parsedUrl['query'], $queryParams);
            $videoId = $queryParams['v'];
            return "https://www.youtube.com/embed/" . $videoId . "?autoplay=1";
        }

        // Обработка коротких видео (shorts)!
        if (strpos($url, 'youtube.com/shorts/') !== false) {
            // Получаем идентификатор видео из пути URL
            $videoId = ltrim($parsedUrl['path'], '/shorts/');
            return "https://www.youtube.com/embed/" . $videoId . "?autoplay=1";
        }

        // Если URL не соответствует ни одному из условий, возвращаем исходный URL
        return null;
    }

    $embedUrl = youtubeEmbedUrl($data['link']);
}
?>

<div class="container">
    <?php if (!empty($data['title'])) : ?>
        <h2><?php echo $data['title']; ?></h2>
    <?php endif; ?>
    <?php if ($data['type'] == 'link'): ?>
        <div class="video-container">
            <iframe
                src="<?= $embedUrl ?>"
                frameborder="0"
                allow="accelerometer; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                allowfullscreen></iframe>
        </div>
    <?php else: ?>
        <div class="video-container">
            <video src="<?= $fileUrl ?>" autoplay></video>
        </div>
    <?php endif; ?>
    <?php require app('path.views') . '/constructor/_buttons.php'; ?>
</div>