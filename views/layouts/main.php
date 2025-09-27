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
$this->registerLinkTag(['rel' => 'icon', 'type' => 'image/svg+xml', 'href' => Yii::getAlias('@web/favicon.svg')]);
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

<header id="header">
    <?php
    NavBar::begin([
        'brandLabel' => 'News Hub',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => ['class' => 'navbar-expand-md navbar-dark bg-dark fixed-top']
    ]);
            echo Nav::widget([
            'options' => ['class' => 'navbar-nav ms-auto'],
            'items' => [
                ['label' => 'Home', 'url' => ['/site/index']],
                [
                    'label' => 'País',
                    'items' => [
                        ['label' => 'Brasil', 'url' => ['/site/index', 'country' => 'Brazil']],
                        ['label' => 'Argentina', 'url' => ['/site/index', 'country' => 'Argentina']],
                        ['label' => 'Estados Unidos', 'url' => ['/site/index', 'country' => 'United States']],
                        ['label' => 'França', 'url' => ['/site/index', 'country' => 'France']],
                        ['label' => 'Alemanha', 'url' => ['/site/index', 'country' => 'Germany']],
                    ],
                ],
                [
                    'label' => 'Categoria',
                    'items' => [
                        ['label' => 'Todas', 'url' => ['/site/index', 'category' => 'all']],
                        ['label' => 'Mundo', 'url' => ['/site/index', 'category' => 'world']],
                        ['label' => 'Política', 'url' => ['/site/index', 'category' => 'politics']],
                        ['label' => 'Esportes', 'url' => ['/site/index', 'category' => 'sport']],
                        ['label' => 'Tecnologia', 'url' => ['/site/index', 'category' => 'technology']],
                        ['label' => 'Negócios', 'url' => ['/site/index', 'category' => 'business']],
                        ['label' => 'Ciência', 'url' => ['/site/index', 'category' => 'science']],
                        ['label' => 'Cultura', 'url' => ['/site/index', 'category' => 'culture']],
                        ['label' => 'Sociedade', 'url' => ['/site/index', 'category' => 'society']],
                        ['label' => 'Meio Ambiente', 'url' => ['/site/index', 'category' => 'environment']],
                    ],
                ],
                !Yii::$app->user->isGuest ? ['label' => 'Dashboard', 'url' => ['/dashboard/index']] : '',
                Yii::$app->user->isGuest ? (
                    ['label' => 'Login', 'url' => ['/site/login']]
                ) : (
                    '<li>'
                    . Html::beginForm(['/site/logout'], 'post', ['class' => 'd-flex'])
                    . Html::submitButton(
                        'Logout (' . Yii::$app->user->identity->username . ')',
                        ['class' => 'btn btn-link nav-link']
                    )
                    . Html::endForm()
                    . '</li>'
                )
            ],
        ]);
    NavBar::end();
    ?>
</header>

<!-- Banner News Hub -->
<div class="news-hub-banner">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-md-2">
                <div class="logo-container">
                    <div class="news-hub-icon">
                        <div class="speech-bubble">
                            <div class="article-icon">
                                <div class="article-image"></div>
                                <div class="article-lines">
                                    <div class="line line-1"></div>
                                    <div class="line line-2"></div>
                                    <div class="line line-3"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-10">
                <h1 class="news-hub-title">NEWS HUB</h1>
                <p class="news-hub-subtitle">Sua fonte confiável de notícias em tempo real</p>
            </div>
        </div>
    </div>
</div>


<main id="main" class="flex-shrink-0" role="main">
    <div class="container">
        <?php if (!empty($this->params['breadcrumbs'])): ?>
            <?= Breadcrumbs::widget(['links' => $this->params['breadcrumbs']]) ?>
        <?php endif ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</main>

<footer id="footer" class="mt-auto py-3 bg-light">
    <div class="container">
        <div class="row text-muted">
            <div class="col-md-6 text-center text-md-start">&copy; News Hub <?= date('Y') ?></div>
            <div class="col-md-6 text-center text-md-end"><?= Yii::powered() ?></div>
        </div>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>


