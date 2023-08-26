<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;
use yii\helpers\Url;

AppAsset::register($this);

$this->registerCsrfMetaTags();
$this->registerMetaTag(['charset' => Yii::$app->charset], 'charset');
$this->registerMetaTag(['name' => 'viewport', 'content' => 'width=device-width, initial-scale=1, shrink-to-fit=no']);
$this->registerMetaTag(['name' => 'description', 'content' => $this->params['meta_description'] ?? '']);
$this->registerMetaTag(['name' => 'keywords', 'content' => $this->params['meta_keywords'] ?? '']);
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/x-icon', 'href' => Yii::getAlias('@web/favicon.ico')]);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="d-flex flex-column h-100">
<?php $this->beginBody() ?>

<header>

    <div class="header-logo">
        <div class="container container-header">
            <a class="logo-a" href="/">
                <?= Html::img(Yii::getAlias('@web').'/img/logo.png') ?>
            </a>

                <ul class="ul-header">
                    <li class="li-header"><?= Html::a('О нас','../site/about') ?></li>
                    <li class="li-header"><?= Html::a('Билеты','../site/tickets') ?>
<!--                    <li>Поддержка 8 800 9550 3334</li>-->
                </ul>
        </div>
    </div>

</header>

<main id="main" class="flex-shrink-0" role="main">
    <?= $content ?>
</main>

<div style="background: #3A3A3A; color: white; bottom: 0" class="footer-container">

    <div class="container">
      <footer class="row row-cols-1 row-cols-sm-2 row-cols-md-5 py-5 my-5 border-top">
        <div class="col mb-3">
          <a href="/" class="d-flex align-items-center mb-3 link-body-emphasis text-decoration-none">
              <?= Html::img(Yii::getAlias('@web').'/img/logo.png') ?>
          </a>
          <p class="text-body-white">© 2023</p>
        </div>

        <div class="col mb-3">

        </div>

        <div class="col mb-3">

        </div>

        <div class="col mb-3">
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><?= Html::a('О нас','../site/about') ?></li>
            <li class="nav-item mb-2"><?= Html::a('Билеты','../site/tickets') ?></li>
            <li class="nav-item mb-2"><a href="#">Для администратора</a></li>
          </ul>
        </div>

        <div class="col mb-3">
          <h5>Связь с нами</h5>
          <ul class="nav flex-column">
            <li class="nav-item mb-2"><a href="mailto:ethree2023@mail.ru">Email: ethree2023@mail.ru</a></li>
            <li class="nav-item mb-2">Телефон: 8 800 955 3334</li>
            <li class="nav-item mb-2">Адрес: г. Кострома, ул. Советская, д. 147</li>
          </ul>
        </div>
      </footer>
    </div>

</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
