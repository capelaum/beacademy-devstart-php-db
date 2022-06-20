<?php

declare(strict_types=1);

namespace App\Controller;

abstract class AbstractController
{
  public function render(string $view, array $data = null): void
  {
    include __DIR__ . "/../View/{$view}.php";
  }
}
