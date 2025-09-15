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
                <a class="btn btn-secondary" href="<?= Url::to(['site/home', 'page' => $currentPage - 1]) ?>">« Anterior</a>
            <?php else: ?>
                <span></span>
            <?php endif; ?>

            <?php if ($currentPage < $totalPages): ?>
                <a class="btn btn-secondary" href="<?= Url::to(['site/home', 'page' => $currentPage + 1]) ?>">Próximo »</a>
            <?php else: ?>
                <span></span>
            <?php endif; ?>
        </div>
    <?php endif; ?>
</div>
