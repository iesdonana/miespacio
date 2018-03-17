<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\models\DatosUsuarios;
use app\assets\AppAsset;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?php
    $items = [];
    $datosUsuario = DatosUsuarios::findOne([
        'usuario_id'=>Yii::$app->user->id,
    ]);

    if (Yii::$app->user->isGuest) {
        $items = [
            [
                'label'=>Html::tag(
                    'span',
                    '',
                    ['class'=>'glyphicon glyphicon-log-in icono-x2']
                ) . ' Iniciar sesión',
                'url'=>['site/login'],
                'encode'=>false,
            ],
            [
                'label'=>Html::tag(
                    'span',
                    '',
                    ['class'=>'glyphicon glyphicon-registration-mark icono-x2']
                ) . ' Registrarse',
                'url'=>['usuarios/create'],
                'encode'=>false,
            ]
        ];
    } else {
        $items = [
            [
                'label'=>Html::tag(
                    'span',
                    '',
                    ['class'=>'glyphicon glyphicon-plus icono-x2']
                ),
                'items'=>[
                    [
                        'label'=>'Crear equipo...',
                        'url'=>['equipos/create']
                    ],
                    [
                        'label'=>'Crear tablero...',
                        'url'=>['tableros/create'],
                    ]
                ],
                'encode'=>false,
            ],
            [
                'label'=> Html::tag(
                    'span',
                    ' ',
                    ['class'=>'glyphicon glyphicon-align-justify icono-x2']
                ),
                'url'=>['equipos/index'],
                'encode'=>false,
            ],
            [
                'label'=>Html::tag(
                    'span',
                    ' ',
                    ['class'=>'glyphicon glyphicon-user icono-x2']
                ),
                'items' => [
                    Html::tag(
                        'li',
                        $datosUsuario->nombre_completo
                        . ' (' . Yii::$app->user->identity->nombre . ')',
                        ['class'=>'dropdown-header icono-x1']
                    ),
                    Html::tag(
                        'li',
                        '',
                        ['class'=>'divider']
                    ),
                    [
                        'label'=>Html::tag(
                            'span',
                            ' ',
                            ['class'=>'glyphicon glyphicon-list icono-x2']
                        ) . ' Perfil',
                        'url'=>['datos-usuarios/view'],
                        'encode'=>false,
                    ],
                    [
                        'label'=>Html::tag(
                            'span',
                            ' ',
                            ['class'=>'glyphicon glyphicon-off icono-x2']
                        ) . ' Cerrar sesión',
                        'url'=>['site/logout'],
                        'linkOptions'=>['data-method'=>'POST'],
                        'encode'=>false,
                    ],

                ],
                'encode'=>false,

            ],
        ];
    }
?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' =>
            Html::tag(
                'p',
                Html::img(
                    '/images/logotipo.png',
                    [
                        'alt'=>'logotipo',
                        'class'=>'logo',
                    ]
                ) .  ' ' . Yii::$app->name
            ),
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top nav-estilo',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right item-estilo'],
        'items'=>$items,
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= Alert::widget() ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; MiEspacio</p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
