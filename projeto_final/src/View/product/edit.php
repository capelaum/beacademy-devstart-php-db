<h1>Editar Produto <?= $data->id ?></h1>

<form action="" method="POST">
  <label for="name" class="mt-4">Nome</label>
  <input type="text" name="name" class="form-control" value="<?= $data->name ?>">

  <label for="description" class="mt-4">Description</label>
  <textarea name="description" class="form-control "><?= $data->description ?></textarea>

  <label for="photo" class="mt-4">URL da imagem</label>
  <input type="text" name="photo" class="form-control" value="<?= $data->photo ?>">

  <label for="value" class="mt-4">Preço</label>
  <input type="number" min="0.1" max="99999" step="0.01" name="value" class="form-control" value="<?= $data->value ?>">

  <label for="quantity" class="mt-4">Quantidade</label>
  <input type="number" min="0" max="99999" name="quantity" class="form-control" value="<?= $data->quantity ?>">

  <label for="category_id" class="mt-4">Categoria</label>
  <select name="category_id" class="form-control">
    <option value="<?= $data->category_id ?>" selected><?= $data->category_name ?></option>
    <?php foreach ($data->categories as $category) : ?>
      <?php if ($category->id == $data->category_id) : ?>
        <?php continue; ?>
      <?php endif; ?>
      <option value="<?= $category->id ?>"><?= $category->name ?></option>
    <?php endforeach; ?>
  </select>

  <button type="submit" class="btn btn-primary my-4">Enviar</button>
</form>
