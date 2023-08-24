<?php

/** @var yii\web\View $this */
/** @var string $content */

use app\assets\AppAsset;
use app\widgets\Alert;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

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
                <img src="<?= \yii\helpers\Url::to('img/logo.png') ?>" alt="Логотип">
            </a>

                <ul class="ul-header">
                    <li class="li-header"><a href="">О нас</a></li>
                    <li class="li-header"><a href="">Билеты</a></li>
<!--                    <li>Поддержка 8 800 9550 3334</li>-->
                </ul>
        </div>
    </div>

</header>

<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">

    <img style="width: 100%; position: absolute" src="<?= \yii\helpers\Url::to('img/footer.png') ?>" alt="">

    <div class="container container-footer">
        <a href="/"><img style="width: 9%" src="<?= \yii\helpers\Url::to('img/logo.png') ?>" alt=""></a>
        <ul class="ul-footer">
            <li class="li-footer"><a href="#">О нас</a></li>
            <li class="li-footer"><a href="">Билеты</a></li>
            <li class="li-footer"><a href="">Для администратора</a></li>
        </ul>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
