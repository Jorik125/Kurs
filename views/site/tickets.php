<?php

$this->title = 'Билеты';
?>

<h1><?= $this->title ?></h1>

<p>Для того чтобы попасть на Electronic Entertainment Expo необходим специальный билет, компания E Three предлагает на выбор три билета, каждый из которых имеет свою привилегию.</p>

<div class="container px-4 py-3" id="featured-3">
    <h2 align="center" class="pb-2">Прайс</h2>
    <div class="row g-4 py-3 row-cols-1 row-cols-lg-3">
        <?php foreach ($model as $tickets) { ?>
              <div class="feature col">
                <h3 class="fs-2 text-body-emphasis"><?= $tickets['name'] ?></h3>
                  <hr>
                  <p><strong>Информация</strong></p>
                <?php foreach (json_decode($tickets['info']) as $info) { ?>
                    <p><?= $info ?></p>
                <?php } ?>
                <h3>Цена <?= $tickets['price'] ?></h3>
              </div>
        <?php } ?>
    </div>
  </div>
