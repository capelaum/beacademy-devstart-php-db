<h1 class="mb-5">Lista de Categorias</h1>

<table class="table table-hover table-striped">
  <thead class="table-dark">
    <tr>
      <th>ID</th>
      <th>Nome</th>
      <th>Descrição</th>
      <th>Data de criação</th>
      <th>Ações</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach ($data as $category) {
      $createdAt = date_fmt($category->created_at, "d/m/Y");
      $editUrl = BASE_URL . "/categorias/edit?id={$category->id}";
      $deleteUrl = BASE_URL . "/categorias/delete?id={$category->id}";

      echo "<tr>";
      echo "<td>{$category->id}</td>";
      echo "<td>{$category->name}</td>";
      echo "<td>{$category->description}</td>";
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
