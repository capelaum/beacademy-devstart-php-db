<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\Connection;

class ProductController extends AbstractController
{
  public function listAction(array $message = null): void
  {
    $connection = Connection::getInstance();

    $query = "
    SELECT
      p.id,
      p.name,
      p.description,
      p.photo,
      p.value,
      p.quantity,
      p.created_at,
      c.name as category_name
    FROM products p
    JOIN categories c ON p.category_id = c.id
    ORDER BY p.id
    ";

    $result = $connection->prepare($query);
    $result->execute();

    $products = [];

    while ($product = $result->fetch()) {
      $products[] = $product;
    }

    $this->render('product/list', $products, $message);
  }

  public function addAction(): void
  {
    $connection = Connection::getInstance();

    if ($_POST) {
      $params = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);

      $query = "
      INSERT INTO products (name, description, photo, value, quantity, category_id)
      VALUES (:name, :description, :photo, :value, :quantity, :category_id)
      ";

      $result = $connection->prepare($query);

      foreach ($params as $key => &$val) {
        $result->bindParam($key, $val);
      }

      $result->execute();

      $message['message'] = 'Produto criado com sucesso!';
      $message['type'] = 'success';

      $this->listAction($message);
      return;
    }

    $categories = $this->getCategories();

    $this->render('product/add', $categories);
  }

  public function editAction(): void
  {
    $connection = Connection::getInstance();

    if (isset($_GET['id'])) {
      $id = (int) $_GET['id'];
    }

    if ($_POST) {
      $params = filter_var_array($_POST, FILTER_SANITIZE_SPECIAL_CHARS);

      $query = "
      UPDATE products SET
        name = :name,
        description = :description,
        photo = :photo,
        value = :value,
        quantity = :quantity,
        category_id = :category_id
      WHERE id = :id
      ";

      $result = $connection->prepare($query);

      $result->bindParam('id', $id);

      foreach ($params as $key => &$val) {
        $result->bindParam($key, $val);
      }

      $result->execute();

      $message['message'] = 'Produto editado com sucesso!';
      $message['type'] = 'success';

      $this->listAction($message);
      return;
    }

    $query = "
    SELECT
      p.id,
      p.name,
      p.description,
      p.photo,
      p.value,
      p.quantity,
      p.category_id,
      c.name as category_name
    FROM products p
    JOIN categories c ON p.category_id = c.id
    WHERE p.id = :id
    ";
    $result = $connection->prepare($query);
    $result->bindParam('id', $id);
    $result->execute();

    $product = $result->fetch();

    $product->categories = $this->getCategories();

    $this->render('product/edit', $product);
  }

  public function deleteAction(): void
  {
    if (isset($_GET['id'])) {
      $connection = Connection::getInstance();

      $query = 'DELETE FROM products WHERE id = :id';
      $result = $connection->prepare($query);
      $result->bindParam('id', $_GET['id']);
      $result->execute();

      $message['message'] = 'Produto excluído com sucesso!';
      $message['type'] = 'success';

      $this->listAction($message);
      return;
    }
  }

  public function getCategories(): array
  {
    $connection = Connection::getInstance();

    $query = 'SELECT * FROM categories';
    $result = $connection->prepare($query);
    $result->execute();

    $categories = [];

    while ($category = $result->fetch()) {
      $categories[] = $category;
    }

    return $categories;
  }
}
