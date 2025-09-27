<?php
use yii\helpers\Html;
use yii\helpers\Url;

/* @var $news array */
/* @var $currentPage int */
/* @var $totalPages int */
/* @var $query string */

$this->title = 'Últimas Notícias';
?>

<div class="container mt-4">
    <h1><?= Html::encode($this->title) ?></h1>

    <!-- Caixa de pesquisa -->
    <?= Html::beginForm(['news/search'], 'get', ['class' => 'mb-4']) ?>
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Pesquisar notícias..." value="<?= Html::encode($query) ?>">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </div>
    <?= Html::endForm() ?>

    <!-- Filtros -->
    <div class="row mb-3">
        <div class="col-md-6">
            <form method="get" id="country-form" action="<?= Url::to(['site/index']) ?>">
                <input type="hidden" name="category" value="<?= Html::encode($category) ?>">
                <label for="country-select">Selecione o país:</label>
                <select name="country" id="country-select" class="form-select" style="width:auto;display:inline-block;" onchange="document.getElementById('country-form').submit();">
                    <option value="Brazil" <?= $country === 'Brazil' ? 'selected' : '' ?>>Brasil</option>
                    <option value="Argentina" <?= $country === 'Argentina' ? 'selected' : '' ?>>Argentina</option>
                    <option value="United States" <?= $country === 'United States' ? 'selected' : '' ?>>Estados Unidos</option>
                    <option value="France" <?= $country === 'France' ? 'selected' : '' ?>>França</option>
                    <option value="Germany" <?= $country === 'Germany' ? 'selected' : '' ?>>Alemanha</option>
                    <!-- Adicione mais países conforme necessário -->
                </select>
            </form>
        </div>
        <div class="col-md-6">
            <form method="get" id="category-form" action="<?= Url::to(['site/index']) ?>">
                <input type="hidden" name="country" value="<?= Html::encode($country) ?>">
                <label for="category-select">Selecione a categoria:</label>
                <select name="category" id="category-select" class="form-select" style="width:auto;display:inline-block;" onchange="document.getElementById('category-form').submit();">
                    <?php foreach ($categories as $key => $label): ?>
                        <option value="<?= Html::encode($key) ?>" <?= $category === $key ? 'selected' : '' ?>><?= Html::encode($label) ?></option>
                    <?php endforeach; ?>
                </select>
            </form>
        </div>
    </div>

    <!-- Últimas notícias -->
    <?php if (empty($news)): ?>
        <p>Nenhuma notícia encontrada.</p>
    <?php else: ?>
        <div class="row">
            <?php foreach ($news as $item): ?>
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <?php if (!empty($item['thumbnail'])): ?>
                            <img src="<?= Html::encode($item['thumbnail']) ?>" class="card-img-top" alt="<?= Html::encode($item['title']) ?>">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="<?= Html::encode($item['url']) ?>" target="_blank"><?= Html::encode($item['title']) ?></a>
                            </h5>
                            <p class="card-text"><?= Html::encode($item['description']) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Paginação -->
        <div class="mt-4 d-flex justify-content-between">
            <?php if ($currentPage > 1): ?>
                <a class="btn btn-secondary" href="<?= Url::to(['site/index', 'page' => $currentPage - 1, 'q' => $query, 'country' => $country, 'category' => $category]) ?>">« Anterior</a>
            <?php else: ?>
                <span></span>
            <?php endif; ?>

            <?php if ($currentPage < $totalPages): ?>
                <a class="btn btn-secondary" href="<?= Url::to(['site/index', 'page' => $currentPage + 1, 'q' => $query, 'country' => $country, 'category' => $category]) ?>">Próximo »</a>
            <?php else: ?>
                <span></span>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>
