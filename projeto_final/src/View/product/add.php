<h1>Adicionar Produto</h1>

<form action="" method="POST">
  <label for="name" class="mt-4">Nome</label>
  <input type="text" name="name" class="form-control" required>

  <label for="description" class="mt-4">Description</label>
  <textarea name="description" class="form-control" required></textarea>

  <label for="photo" class="mt-4">URL da imagem</label>
  <input type="text" name="photo" class="form-control" required>

  <label for="value" class="mt-4">Preço</label>
  <input type="number" min="0.1" step="0.01" name="value" class="form-control" required>

  <label for="quantity" class="mt-4">Quantidade</label>
  <input type="number" min="0" max="99999" name="quantity" class="form-control" required>

  <label for="category_id" class="mt-4">Categoria</label>
  <select name="category_id" class="form-select" required>
    <option value="" selected disable hidden>-- Selecione --</option>
    <?php foreach ($data as $category) : ?>
      <option value="<?= $category->id ?>"><?= $category->name ?></option>
    <?php endforeach; ?>
  </select>

  <button type="submit" class="btn btn-primary my-4">Criar</button>
</form>
