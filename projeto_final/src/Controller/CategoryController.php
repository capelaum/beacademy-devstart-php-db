<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\Connection;

class CategoryController extends AbstractController
{
  public function listAction(array $message = null): void
  {
    $connection = Connection::getInstance();

    $query = 'SELECT * FROM categories ORDER BY id';
    $result = $connection->prepare($query);
    $result->execute();

    $categories = [];

    while ($category = $result->fetch()) {
      $categories[] = $category;
    }

    $this->render('category/list', $categories, $message);
  }

  public function addAction(): void
  {
    if ($_POST) {
      $connection = Connection::getInstance();

      $params = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);

      $query = 'INSERT INTO categories (name, description) VALUES (:name, :description)';
      $result = $connection->prepare($query);

      foreach ($params as $key => &$val) {
        $result->bindParam($key, $val);
      }

      $result->execute();

      $message['message'] = urlencode('Categoria criada com sucesso!');
      $message['type'] = urlencode('success');

      $this->listAction($message);
      return;
    }


    $this->render('category/add');
  }

  public function editAction(): void
  {
    $connection = Connection::getInstance();

    if (isset($_GET['id'])) {
      $id = (int) $_GET['id'];
    }

    if ($_POST) {
      $connection = Connection::getInstance();

      $params = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);

      $query = 'UPDATE categories SET name = :name, description = :description WHERE id = :id';
      $result = $connection->prepare($query);

      $result->bindParam('id', $id);

      foreach ($params as $key => &$val) {
        $result->bindParam($key, $val);
      }

      $result->execute();

      $message['message'] = urlencode('Categoria editada com sucesso!');
      $message['type'] = urlencode('success');

      $this->listAction($message);
      return;
    }

    $query = 'SELECT * FROM categories WHERE id = :id';
    $result = $connection->prepare($query);
    $result->bindParam('id', $id);
    $result->execute();

    $category = $result->fetch();
    $this->render('category/edit', $category);
  }

  public function deleteAction(): void
  {
    if (isset($_GET['id'])) {
      $connection = Connection::getInstance();

      $query = 'DELETE FROM categories WHERE id = :id';
      $result = $connection->prepare($query);
      $result->bindParam('id', $_GET['id']);
      $result->execute();

      $message['message'] = urlencode('Categoria excluída com sucesso!');
      $message['type'] = urlencode('success');

      $this->listAction($message);
      return;
    }
  }
}
