<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\tabs\TabsX;
use yii\widgets\ListView;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $model app\models\Equipos */
/* @var $tableros app\models\Tableros */
/* @var $tablero_crear app\models\Tableros */


$this->title = $model->denominacion;
$this->params['breadcrumbs'][] = [
    'label' => 'Tableros | MiEspacio',
    'url' => ['equipos/gestionar-tableros']
];

//  Contenido de pestañas
$items = [
    [
        //  Lista de tableros del equipo.
        'label'=>"<span class='glyphicon glyphicon-align-justify'></span>
                Tableros",
        'content'=> $this->render('tableros_equipo', [
            'tableros'=>$tableros,
            'tablero_crear'=>$tablero_crear,
            'equipo'=>$model,
        ]),
    ],
    [
        //  Modificación del equipo.
        'label'=>"<span class='glyphicon glyphicon-wrench'></span>
                Configuración",
        'content'=> $this->render('update', [
            'equipo'=>$model,
        ]),
    ]
];
$css = <<<EOT
    .contenido {
        display: flex;
        justify-content: center;
        flex-direction: column;
        align-items: center;
    }

    .cabecera {
        display: flex;
        justify-content: center;
    }
EOT;

$this->registerCss($css);

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipos-view">
    <!-- Nombre del equipo e imagen -->
    <div class='row'>
        <div class='contenido'>
            <div class='cabecera'>
                <h2>
                    <?php if ($model->url_imagen === null): ?>
                        <span class='label label-primary icono-x3'>
                            <span class='glyphicon glyphicon-list-alt'></span>
                        </span>
                    <?php else: ?>
                        <img src="<?= $model->url_imagen ?>">
                    <?php endif; ?>
                    &nbsp;
                    <strong>
                        <?= Html::encode($this->title) ?>
                    </strong>
                </h2>
            </div>
            <br>
            <p><?= Html::encode($model->descripcion) ?></p>
        </div>
    </div>
    <br>

    <!-- Pestañas de selección -->
    <?=
        TabsX::widget([
            'items'=>$items,
            'position'=>TabsX::POS_ABOVE,
            'align'=>TabsX::ALIGN_CENTER,
            'encodeLabels'=>false,
        ])
    ?>

</div>
