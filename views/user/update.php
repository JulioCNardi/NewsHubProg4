<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Editar Conta';
?>

<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'password')->passwordInput()
        ->hint('Deixe em branco se não quiser alterar a senha') ?>

    <div class="form-group">
        <?= Html::submitButton('Salvar', ['class' => 'btn btn-success']) ?>
        <?= Html::a('Cancelar', ['dashboard/index'], ['class'=>'btn btn-secondary']) ?>
    </div>

<?php ActiveForm::end(); ?>
