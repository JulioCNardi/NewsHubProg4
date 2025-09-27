<?php

/** @var yii\web\View $this */
/** @var array $news Dados das notícias */

$this->title = 'Últimas Notícias';

?>
<div class="container my-4">
    <h1 class="mb-4">Últimas Notícias</h1>

    <?php
    if (isset($news['response']['results']) && is_array($news['response']['results'])) {
        ?>
        <div class="row">
            <?php foreach ($news['response']['results'] as $article): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <?php if (isset($article['fields']['thumbnail'])): ?>
                            <img src="<?= $article['fields']['thumbnail'] ?>" class="card-img-top" alt="<?= $article['webTitle'] ?>" style="height: 200px; object-fit: cover;">
                        <?php endif; ?>
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= $article['webTitle'] ?></h5>
                            <p class="card-text text-muted flex-grow-1"><?= $article['fields']['trailText'] ?? '' ?></p>
                            <a href="<?= $article['webUrl'] ?>" 
                               class="btn btn-primary mt-auto news-click-track" 
                               target="_blank"
                               data-title="<?= htmlspecialchars($article['webTitle']) ?>"
                               data-url="<?= htmlspecialchars($article['webUrl']) ?>"
                               data-description="<?= htmlspecialchars($article['fields']['trailText'] ?? '') ?>">Ler mais</a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <?php
    } else {
        echo '<p>Não foi possível carregar as notícias. Tente novamente mais tarde.</p>';
        if (isset($news['error'])) {
            echo '<p>Erro da API: ' . $news['error'] . '</p>';
        }
    }
    ?>
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
