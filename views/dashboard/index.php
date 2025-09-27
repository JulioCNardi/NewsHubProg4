<?php
use yii\helpers\Html;

$this->title = 'Dashboard';
?>

<div class="site-dashboard">
    <h1>Bem-vindo, <?= Html::encode(Yii::$app->user->identity->username) ?>!</h1>
    <p>Ações disponíveis para sua conta:</p>

    <div class="row">
        <!-- Card Editar Conta -->
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card text-center" style="margin-bottom:20px; border:1px solid #ddd; border-radius:10px; padding:20px;">
                <h3>✏️ Editar Conta</h3>
                <p>Atualize seus dados de usuário e senha.</p>
                <?= Html::a('Editar', ['user/update', 'id' => Yii::$app->user->id], ['class' => 'btn btn-warning']) ?>
            </div>
        </div>

        <!-- Card Deletar Conta -->
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card text-center" style="margin-bottom:20px; border:1px solid #ddd; border-radius:10px; padding:20px;">
                <h3>🗑️ Deletar Conta</h3>
                <p>Exclua permanentemente sua conta.</p>
                <?= Html::a('Deletar', ['user/delete', 'id' => Yii::$app->user->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Tem certeza que deseja deletar sua conta? Essa ação não pode ser desfeita.',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
        </div>

        <!-- Card Histórico de Notícias -->
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card text-center" style="margin-bottom:20px; border:1px solid #ddd; border-radius:10px; padding:20px;">
                <h3>📰 Histórico de Notícias</h3>
                <p>Visualize o histórico das notícias que você clicou recentemente.</p>
                <?= Html::a('Ver Histórico', ['news/history'], ['class' => 'btn btn-info']) ?>
            </div>
        </div>
    </div>
</div>
