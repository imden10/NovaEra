<?php
custom_log('start');
// Заборонити прямий доступ до файлу
defined('ABSPATH') or die('No direct access allowed.');

// Обробник вебхуків
function handle_webhook() {
    custom_log('handle_webhook');
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

    custom_log('event_type');

    // Обробка подій
    switch ($event_type) {
        case 'push':
            // Виконати git pull або інші дії для розгортання
            custom_log('push');
            exec('cd /home/ka522929/sisidev.com.ua/www && git pull');
            break;

        // Додайте додаткові випадки для інших подій

        default:
            http_response_code(400);
            die('Unsupported event type');
    }

    custom_log('Webhook processed successfully');

    http_response_code(200);
    die('Webhook processed successfully');
}

// Викликати функцію обробки вебхука
handle_webhook();

function custom_log($message) {
    // Шлях до файлу логів
    $log_file = __DIR__ . '/log.txt';

    // Формат повідомлення з часом
    $log_message = '[' . date('Y-m-d H:i:s') . '] ' . $message . PHP_EOL;

    // Додаємо лог у файл
    file_put_contents($log_file, $log_message, FILE_APPEND | LOCK_EX);
}