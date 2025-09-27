<?php
use yii\helpers\Html;
use yii\helpers\Url;

$this->title = 'Histórico de Notícias';
?>

<div class="site-history">
    <div class="row">
        <div class="col-lg-12">
            <h1>📰 Histórico de Notícias</h1>
            <p class="lead">Aqui estão as notícias que você clicou recentemente.</p>
            
            <?php if (Yii::$app->session->hasFlash('success')): ?>
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <?= Yii::$app->session->getFlash('success') ?>
                </div>
            <?php endif; ?>

            <?php if (Yii::$app->session->hasFlash('error')): ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <?= Yii::$app->session->getFlash('error') ?>
                </div>
            <?php endif; ?>

            <div class="row mb-3">
                <div class="col-lg-6">
                    <?= Html::a('← Voltar ao Dashboard', ['dashboard/index'], ['class' => 'btn btn-secondary']) ?>
                </div>
                <div class="col-lg-6 text-right">
                    <?= Html::a('🗑️ Limpar Histórico', ['news/clear-history'], [
                        'class' => 'btn btn-danger',
                        'data' => [
                            'confirm' => 'Tem certeza que deseja limpar todo o seu histórico? Esta ação não pode ser desfeita.',
                            'method' => 'post',
                        ],
                    ]) ?>
                </div>
            </div>

            <?php if (empty($history)): ?>
                <div class="alert alert-info text-center">
                    <h4>📭 Nenhuma notícia no histórico</h4>
                    <p>Você ainda não clicou em nenhuma notícia. Comece a navegar pelas notícias para ver seu histórico aqui!</p>
                    <?= Html::a('Ver Últimas Notícias', ['news/index'], ['class' => 'btn btn-primary']) ?>
                </div>
            <?php else: ?>
                <div class="row">
                    <?php foreach ($history as $item): ?>
                        <div class="col-lg-6 col-md-6 col-sm-12 mb-4">
                            <div class="card h-100" style="border: 1px solid #ddd; border-radius: 10px; box-shadow: 0 2px 4px rgba(0,0,0,0.1);">
                                <div class="card-body">
                                    <h5 class="card-title" style="font-size: 1.1em; line-height: 1.3;">
                                        <?= Html::encode($item->title) ?>
                                    </h5>
                                    
                                    <?php if (!empty($item->description)): ?>
                                        <p class="card-text" style="color: #666; font-size: 0.9em;">
                                            <?= Html::encode($item->description) ?>
                                        </p>
                                    <?php endif; ?>
                                    
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            📅 <?= date('d/m/Y H:i', strtotime($item->clicked_at)) ?>
                                        </small>
                                        <div>
                                            <?= Html::a('🔗 Ver Notícia', $item->url, [
                                                'class' => 'btn btn-sm btn-outline-primary',
                                                'target' => '_blank',
                                                'rel' => 'noopener noreferrer'
                                            ]) ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="row mt-4">
                    <div class="col-12 text-center">
                        <p class="text-muted">
                            <small>Mostrando os últimos <?= count($history) ?> cliques</small>
                        </p>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>

<style>
.card:hover {
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
    transition: all 0.3s ease;
}

.card-title {
    color: #333;
    font-weight: 600;
}

.card-text {
    line-height: 1.4;
}

.btn-outline-primary:hover {
    background-color: #007bff;
    border-color: #007bff;
}
</style>
