<?php

declare(strict_types=1);

namespace App\Controller;

class ProductController extends AbstractController
{
  public function listAction(): void
  {
    $this->render('product/list');
  }

  public function addAction(): void
  {
    $this->render('product/add');
  }

  public function editAction(): void
  {
    $this->render('product/edit');
  }
}
