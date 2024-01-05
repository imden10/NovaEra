<?php

// Заборонити прямий доступ до файлу
defined('ABSPATH') or die('No direct access allowed.');

// Обробник вебхуків
function handle_webhook() {
    // Перевірка типу події
    $event_type = $_SERVER['HTTP_X_GITHUB_EVENT'];

    // Перевірка підпису (якщо ви використовуєте секрет)
    $github_secret = '39249594530374593149161297056685';
    $headers = getallheaders();
    $hub_signature = $headers['X-Hub-Signature'];
    $payload = file_get_contents('php://input');
    $calculated_signature = 'sha1=' . hash_hmac('sha1', $payload, $github_secret);

    if ($hub_signature !== $calculated_signature) {
        http_response_code(401);
        die('Invalid signature');
    }

    // Обробка подій
    switch ($event_type) {
        case 'push':
            // Виконати git pull або інші дії для розгортання
            exec('cd /home/ka522929/sisidev.com.ua/www && git pull');
            break;

        // Додайте додаткові випадки для інших подій

        default:
            http_response_code(400);
            die('Unsupported event type');
    }

    http_response_code(200);
    die('Webhook processed successfully');
}

// Викликати функцію обробки вебхука
handle_webhook();