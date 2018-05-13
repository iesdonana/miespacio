<?php

/* @var $this \yii\web\View */
/* @var $content string */

use app\widgets\Alert;
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\models\DatosUsuarios;
use app\components\MyHelpers;
use app\assets\AppAsset;
use yii\helpers\Url;

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
    $items[] = [

        'label'=>MyHelpers::icon('glyphicon glyphicon-home')
            . ' Inicio',
        'url'=>['site/index'],
        'encode'=>false,

    ];

    $datosUsuario = DatosUsuarios::findOne([
        'usuario_id'=>Yii::$app->user->id,
    ]);

    if (Yii::$app->user->isGuest) {
        $items[] =
            [
                'label'=>Html::tag(
                    'span',
                    '',
                    ['class'=>'glyphicon glyphicon-log-in ']
                ) . '  Iniciar sesión',
                'url'=>['site/login'],
                'encode'=>false,
            ];
        $items[] =
            [
                'label'=>Html::tag(
                    'span',
                    '',
                    ['class'=>'glyphicon glyphicon-registration-mark ']
                ) . '  Registrarse',
                'url'=>['usuarios/create'],
                'encode'=>false,
            ];
    } else {
        $items[] =
            [
                'label'=> MyHelpers::icon(
                    'glyphicon glyphicon-align-justify '
                ) . ' Mis Tableros',
                'url'=>['equipos/gestionar-tableros'],
                'encode'=>false


            ];

        $items[] =
            [
                'label'=>MyHelpers::icon('glyphicon glyphicon-plus ')
                    . ' Crear Equipo',

                'linkOptions'=>[
                    'data-toggle'=>'modal',
                    'data-target'=>'#modal_create_equipo'
                ],
                'encode'=>false,
            ];

        $items[] =
            [
                'label'=>MyHelpers::icon('glyphicon glyphicon-bell '),

                'linkOptions'=>[
                    'data-toggle'=>'modal',
                    'data-target'=>'#modal_notificaciones'
                ],
                'encode'=>false,
            ];


        $items[] =
            [
                'label'=>Html::img(
                    'images/cargando.gif',
                    ['class'=>'img-circle logo-nav']
                ),
                'items' => [
                    Html::tag(
                        'li',
                        $datosUsuario->nombre_completo
                        . ' ' . $datosUsuario->apellidos
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
                            ['class'=>'glyphicon glyphicon-list ']
                        ) . ' Perfil',
                        'url'=>['datos-usuarios/view'],
                        'encode'=>false,
                    ],
                    [
                        'label'=>Html::tag(
                            'span',
                            ' ',
                            ['class'=>'glyphicon glyphicon-off ']
                        ) . ' Cerrar sesión',
                        'url'=>['site/logout'],
                        'linkOptions'=>['data-method'=>'POST'],
                        'encode'=>false,
                    ],

                ],
                'encode'=>false,
                'linkOptions'=>[
                    'id'=>'avatar_user'
                ]

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
        'brandUrl' => ['equipos/gestionar-tableros'],
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],

    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right item-estilo'],
        'items'=>$items,
    ]);
    NavBar::end();
    ?>

    <?php

        $this->registerJsFile(
            '/js/main.js',
            ['depends'=>[\yii\web\JqueryAsset::className()]]
        );


        if (!Yii::$app->user->isGuest) {
            $img = $datosUsuario->url_imagen;
            $num_notifi = Yii::$app->user->identity
                ->getNotificaciones()
                ->where(['view_at'=>null])
                ->count();

            $url_observar = Url::to([
                'notificaciones/observar',
                'id_usuario'=>Yii::$app->user->id
            ]);

            $this->registerJs("
                $(document).ready(function() {
                    $('img.logo-nav').attr('src', '$img');
                    indicarNotificaciones('$num_notifi', '$url_observar');
                })
            ");
        }
    ?>

    <?= $this->render('modales_main') ?>

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
