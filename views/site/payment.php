<?php

use yii\widgets\ActiveForm;

$this->title = 'Покупка билета';
?>

<div style="background: black">
    <p align="center" style="color: white; font-size: 20px">Купить билет проще чем кажется</p>
    <p align="center" style="color: white; font-size: 20px">Заполни не большую анкету. Не бойся, мы бережно относимся к твоим данным :)</p>

    <h3 align="center" style="color: white">Покупка билета <u style="font-size: 30px"><?= $ticket->name.' '. $ticket->price.' р.' ?></u></h3>

    <div class="container" style="color: white; padding: 10px" align="center">
        <?php $form = ActiveForm::begin() ?>
                <?= $form->field($model, 'name')->textInput(['placeholder'=>'Имя','style'=>'width: 30%','autocomplete'=>'off'])->label(false) ?>
                <?= $form->field($model, 'email')->input('email',['placeholder'=>'Почта','style'=>'margin-top: 20px; width: 30%','autocomplete'=>'off'])->label(false) ?>
                <?= $form->field($model, 'card_number')->textInput(['placeholder'=>'Номер карты','style'=>'margin-top: 20px; width: 30%','autocomplete'=>'off'])->label(false) ?>
                <?= $form->field($model, 'type_tickets_id')->textInput(['value'=>$ticket->id, 'type'=>'hidden'])->label(false) ?>
                <div align="center">
                    <?= \yii\helpers\Html::submitButton('Купить',['class'=>'btn','style'=>'color: white; background: #810707; width: 10%; margin-bottom: 10px; margin-top: 20px']) ?>
                </div>
        <?php ActiveForm::end() ?>
    </div>
</div>
