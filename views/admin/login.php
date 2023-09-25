<?php

/** @var yii\web\View $this */
/** @var yii\bootstrap5\ActiveForm $form */
/** @var app\models\User $model*/


use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Вход';
?>

<div class="container">
    <div class="site-login" style="margin-left: 35%">
        <h1><?= Html::encode($this->title) ?></h1>

        <div class="row">
            <div class="col-lg-5">

                <?php $form = ActiveForm::begin([
                        'id'=>'LoginForm'
                ])?>

                <?= $form->field($model, 'login')->textInput(['class'=>'form-control login'])?>

                <?= $form->field($model, 'password')->passwordInput(['class'=>'form-control password']) ?>

                <div class="form-group">
                    <div>
                        <?= Html::submitButton('Вход', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                    </div>
                </div>

                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
