<div class="d-flex flex-sm-row justify-content-between align-items-center my-4">
  <h1>Lista de Produtos</h1>

  <div>
    <a class="btn btn-primary" href="/produtos/add">Adicionar produto</a>
  </div>
</div>

<table class="table table-hover table-striped">
  <thead class="table-dark">
    <tr>
      <th>ID</th>
      <th>Nome</th>
      <th>Descrição</th>
      <th>Foto</th>
      <th>Preço (R$)</th>
      <th>Categoria</th>
      <th>Quantidade</th>
      <th>Criação</th>
      <th>Ações</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach ($data as $product) {
      $createdAt = date_fmt($product->created_at, "d/m/Y");

      $editUrl = "/produtos/edit?id={$product->id}";
      $deleteUrl = "/produtos/delete?id={$product->id}";

      $price = number_format($product->value, 2, ',', '.');

      echo "<tr>";
      echo "<td>{$product->id}</td>";
      echo "<td>{$product->name}</td>";
      echo "<td>{$product->description}</td>";
      echo
      "<td>
        <img src='{$product->photo}' alt='{$product->name}' class='img-fluid' style='max-width: 100px;'>

      </td>";
      echo "<td>{$price}</td>";
      echo "<td>{$product->category_name}</td>";
      echo "<td>{$product->quantity}</td>";
      echo "<td>{$createdAt}</td>";
      echo
      "<td>
      <a href={$editUrl} class='btn btn-primary btn-sm'>Editar</a>
      <a href={$deleteUrl} class='btn btn-danger btn-sm'>Excluir</a>
    </td>";
      echo "</tr>";
    }
    ?>
  </tbody>
</table>
