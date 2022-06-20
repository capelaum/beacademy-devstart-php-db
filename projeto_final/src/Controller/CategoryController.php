<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\Connection;

class CategoryController extends AbstractController
{
  public function listAction(): void
  {
    $connection = Connection::getInstance();

    $query = 'SELECT * FROM categories';
    $result = $connection->prepare($query);
    $result->execute();

    $categories = [];

    while ($category = $result->fetch()) {
      $categories[] = $category;
    }

    $this->render('category/list', $categories);
  }

  public function addAction(): void
  {
    $this->render('category/add');
  }

  public function editAction(): void
  {
    $this->render('category/edit');
  }
}
