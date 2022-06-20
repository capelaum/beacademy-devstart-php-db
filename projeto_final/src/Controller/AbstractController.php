<?php

declare(strict_types=1);

namespace App\Controller;

abstract class AbstractController
{
  public function render(string $view, array $data = null, array $message = null): void
  {
    include __DIR__ . '/../View/shared/head.php';
    include __DIR__ . '/../View/shared/menu.php';

    include __DIR__ . "/../View/{$view}.php";

    include __DIR__ . '/../View/shared/footer.php';
  }
}
