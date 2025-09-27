<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'Cadastro de Usuário';
?>

<h1><?= Html::encode($this->title) ?></h1>

<?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput() ?>
    <?= $form->field($model, 'password')->passwordInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Cadastrar', ['class' => 'btn btn-primary']) ?>
    </div>

<?php ActiveForm::end(); ?>
