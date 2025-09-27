<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Login';
?>

<h1><?= Html::encode($this->title) ?></h1>

<p>Preencha seus dados para entrar no sistema:</p>

<?php $form = ActiveForm::begin([
    'id' => 'login-form',
]); ?>

    <?= $form->field($model, 'username')->textInput(['autofocus' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput() ?>

    <?= $form->field($model, 'rememberMe')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton('Entrar', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
        <?= Html::a('Cadastrar Usuário', ['site/signup'], ['class' => 'btn btn-success']) ?>
    </div>

<?php ActiveForm::end(); ?>

