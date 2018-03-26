<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use kartik\tabs\TabsX;
use yii\widgets\ListView;

/* @var $this yii\web\View */
/* @var $model app\models\Equipos */

$this->title = $model->denominacion;
$this->params['breadcrumbs'][] = [
    'label' => 'Tableros | MiEspacio',
    'url' => ['equipos/gestionar-tableros']
];

$items = [
    [
        'label'=>"<span class='glyphicon glyphicon-align-justify'></span>
                Tableros",
        'content'=> Html::tag('br') . ListView::widget([
            'dataProvider'=>$tableros,
            'itemView'=>'_tablero',
            'summary'=>'',
        ]),
    ],
    [
        'label'=>"<span class='glyphicon glyphicon-wrench'></span>
                Configuración",
        'content'=>'Configura...'
    ]
];
$css = <<<EOT
    .contenido {
        display: flex;
        justify-content: center;
    }
EOT;

$this->registerCss($css);

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="equipos-view">
    <div class='row'>
        <div class='contenido'>
            <div class='conenido'>
                <h2>
                    <span class='label label-primary icono-x3'>
                        <span class='glyphicon glyphicon-list-alt'></span>
                    </span>
                    &nbsp;
                    <strong>
                        <?= Html::encode($this->title) ?>
                    </strong>
                </h2>
            </div>

            <p><?= Html::encode($model->descripcion) ?></p>
        </div>
    </div>
    <br><br>
    <?=
        TabsX::widget([
            'items'=>$items,
            'position'=>TabsX::POS_ABOVE,
            'align'=>TabsX::ALIGN_CENTER,
            'encodeLabels'=>false,
        ])
    ?>

</div>
