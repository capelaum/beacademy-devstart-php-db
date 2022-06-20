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

    $query = 'SELECT * FROM products';
    $result = $connection->prepare($query);
    $result->execute();

    $products = [];

    while ($product = $result->fetch()) {

      $query = 'SELECT * FROM categories WHERE id = :id';
      $result = $connection->prepare($query);
      $result->bindParam('id', $product->category_id);
      $result->execute();

      $category = $result->fetch();
      $product->category = $category;

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
