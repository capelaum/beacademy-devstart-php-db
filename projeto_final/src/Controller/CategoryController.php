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
    if ($_POST) {
      $connection = Connection::getInstance();

      $params = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);

      $query = 'INSERT INTO categories (name, description) VALUES (:name, :description)';
      $result = $connection->prepare($query);

      foreach ($params as $key => $val) {
        $result->bindParam($key, $val);
      }

      $result->execute();

      redirect('/categorias');
    }


    $this->render('category/add');
  }

  public function editAction(): void
  {
    $this->render('category/edit');
  }
}
