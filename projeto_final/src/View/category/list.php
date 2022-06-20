<h1 class="mb-5">Lista de Categorias</h1>

<table class="table table-hover table-striped">
  <thead class="table-dark">
    <tr>
      <th>ID</th>
      <th>Nome</th>
      <th>Descrição</th>
      <th>Data de criação</th>
    </tr>
  </thead>
  <tbody>
    <?php
    foreach ($data as $category) {
      echo "<tr>";
      echo "<td>{$category->id}</td>";
      echo "<td>{$category->name}</td>";
      echo "<td>{$category->description}</td>";
      $createdAt = date_fmt($category->created_at, "d/m/Y");
      echo "<td>{$createdAt}</td>";
      echo "</tr>";
    }
    ?>
  </tbody>
</table>
