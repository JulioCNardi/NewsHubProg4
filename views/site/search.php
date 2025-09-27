<?php
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $news array|null */
/* @var $query string|null */

$this->title = 'Busca de Notícias';
?>

<div class="container mt-4">
    <h1><?= Html::encode($this->title) ?></h1>

    <!-- Form de busca -->
    <?= Html::beginForm(['news/search'], 'get', ['class' => 'mb-4']) ?>
        <div class="input-group">
            <input type="text" name="q" class="form-control" placeholder="Digite um tema (ex: tecnologia, esportes...)" value="<?= Html::encode($query ?? '') ?>">
            <button class="btn btn-primary" type="submit">Buscar</button>
        </div>
    <?= Html::endForm() ?>

    <!-- Resultados -->
    <?php if ($news === null): ?>
        <p>Digite um termo e clique em "Buscar" para ver resultados.</p>
    <?php elseif (empty($news)): ?>
        <p>Nenhuma notícia encontrada para "<strong><?= Html::encode($query) ?></strong>".</p>
    <?php elseif (isset($news['error'])): ?>
        <p class="text-danger"><?= Html::encode($news['error']) ?></p>
    <?php else: ?>
        <h3>Resultados para "<strong><?= Html::encode($query) ?></strong>":</h3>
        <div class="row">
            <?php foreach ($news as $item): ?>
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <?php if (!empty($item['thumbnail'])): ?>
                            <img src="<?= Html::encode($item['thumbnail']) ?>" class="card-img-top" alt="<?= Html::encode($item['title']) ?>">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title">
                                <a href="<?= Html::encode($item['url']) ?>" 
                                   target="_blank"
                                   class="news-click-track"
                                   data-title="<?= htmlspecialchars($item['title']) ?>"
                                   data-url="<?= htmlspecialchars($item['url']) ?>"
                                   data-description="<?= htmlspecialchars($item['description']) ?>">
                                    <?= Html::encode($item['title']) ?>
                                </a>
                            </h5>
                            <p class="card-text"><?= Html::encode($item['description']) ?></p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Rastrear cliques em notícias
    document.querySelectorAll('.news-click-track').forEach(function(link) {
        link.addEventListener('click', function(e) {
            var title = this.getAttribute('data-title');
            var url = this.getAttribute('data-url');
            var description = this.getAttribute('data-description');
            
            // Enviar dados para o servidor via AJAX
            fetch('<?= \yii\helpers\Url::to(['news/track-click']) ?>', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                    'X-CSRF-Token': '<?= Yii::$app->request->csrfToken ?>'
                },
                body: 'title=' + encodeURIComponent(title) + 
                      '&url=' + encodeURIComponent(url) + 
                      '&description=' + encodeURIComponent(description)
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Clique registrado no histórico');
                } else {
                    console.log('Erro ao registrar clique:', data.message);
                }
            })
            .catch(error => {
                console.log('Erro ao registrar clique:', error);
            });
        });
    });
});
</script>
