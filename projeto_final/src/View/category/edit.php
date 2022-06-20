<h1>Editar Categoria <?= $data->id ?> </h1>

<form action="" method="POST">
  <label for="name" class="mt-4">Nome</label>
  <input type="text" name="name" class="form-control" value="<?= $data->name ?>">

  <label for="description" class="mt-4">Description</label>
  <textarea name="description" class="form-control mb-4"><?= $data->description ?></textarea>

  <button type="submit" class="btn btn-primary">Editar</button>
</form>
