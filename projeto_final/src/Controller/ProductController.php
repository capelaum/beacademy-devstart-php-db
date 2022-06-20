<?php

declare(strict_types=1);

namespace App\Controller;

use App\Core\Connection;

class ProductController extends AbstractController
{
  public function listAction(): void
  {
    $message = null;

    if (isset($_GET['message']) && isset($_GET['type'])) {
      $message['message'] = urldecode($_GET['message']);
      $message['type'] = urldecode($_GET['type']);
    }

    $connection = Connection::getInstance();

    $query = "
    SELECT
      p.id,
      p.name,
      p.description,
      p.photo,
      p.value,
      p.quantity,
      c.name as category_name
    FROM products p
    JOIN categories c ON p.category_id = c.id
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
    $this->render('product/add');
  }

  public function editAction(): void
  {
    $this->render('product/edit');
  }
}
