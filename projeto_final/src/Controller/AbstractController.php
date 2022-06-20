<?php

declare(strict_types=1);

namespace App\Controller;

abstract class AbstractController
{
  public function render(string $view, array|object $data = null, array $message = null): void
  {
    include __DIR__ . '/../View/shared/head.php';

    if (isset($message['message']) && isset($message['type'])) {
      $message['message'] = urldecode($message['message']);
      $message['type'] = urldecode($message['type']);

      include __DIR__ . '/../View/shared/message.php';
    }

    include __DIR__ . "/../View/{$view}.php";

    include __DIR__ . '/../View/shared/footer.php';
  }
}
