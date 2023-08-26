<?php

/** @var yii\web\View $this */

$this->title = 'Главная страница';
?>

<div style="width: auto; height: auto; padding: 20px">

    <video src="<?= \yii\helpers\Url::to('img/videoE3.mp4') ?>" style="position: fixed; right: 0; bottom: 0; min-width: 100%; min-height: 100%; width: auto; height: auto; z-index: -9999" autoplay loop muted></video>
    <div class="container" align="center">
        <h1 align="center" style="color: white">Ежегодная выставка Electronic Entertainment Expo пройдет 01.01.2023. Выставка проходит во всех странах мира. Успей заказать билет! </h1>
        <?= \yii\helpers\Html::button('Заказать билет',['class'=>'btn','style'=>'background: #810707; color: white']) ?>
    </div>
</div>

<h3 align="center" style="margin-top: 20px; color: white">На выставке Electronic Entertainment Expo будет представлено </h3>

<div class="container px-4 py-5" id="featured-3">
    <div class="row g-4 py-5 row-cols-lg-3">
      <div class="feature col">
        <div class="feature-icon d-inline-flex align-items-center justify-content-center f-2 mb-3">
            <img src="<?= \yii\helpers\Url::to('img/pc.png') ?>" alt="Компуктер" style="border-radius: 10px; ">
        </div>
        <p style="color: white">Компьютеры нового поколения</p>
      </div>
      <div class="feature col">
        <div class="feature-icon d-inline-flex align-items-center justify-content-center fs-2 mb-3">
          <img src="<?= \yii\helpers\Url::to('img/fallout.png') ?>" alt="Fallout" style="border-radius: 10px; ">
        </div>
        <p style="color: white">Игровые новинки и косплеи</p>
      </div>
      <div class="feature col">
        <div class="feature-icon d-inline-flex align-items-center justify-content-center fs-2 mb-3">
          <img src="<?= \yii\helpers\Url::to('img/pinpong.png') ?>" alt="PinPong" style="border-radius: 10px;">
        </div>
        <p style="color: white">Новые технологии в сфере IT</p>
      </div>
    </div>
  </div>
