<?php
/** Vista del título del tablero **/

/* @var $model app\models\Tableros */

use yii\helpers\Html;
use yii\helpers\Url;
use app\components\MyHelpers;

$this->registerCssFile(
    '/css/jquery.notice.css'
);

$this->registerJsFile(
    '/js/jquery.notice.js',
    ['depends'=>[\yii\web\JqueryAsset::className()]]
);

$this->registerJsFile(
    '/js/titulo_tablero.js',
    ['depends'=>[\yii\web\JqueryAsset::className()]]
);

$esFavorito = $model->esFavorito;

$url_favorito = Url::to(['favoritos/cambiar-favorito', 'id_tablero'=>$model->id]);
$url_visible = Url::to(['tableros/changed-visibilidad', 'id'=>$model->id]);
$usuario_id = Yii::$app->user->id;

$js = <<<EOT
    $(document).ready(function() {
        let es_favorito = '$esFavorito';
        addEventBoton('$model->id', es_favorito);


        $(`#btn_favorite_$model->id`).on('click', function() {
           addFavorito('$model->id', '$usuario_id', '$url_favorito');
        })

        $(`#btn_visibilidad_$model->id`).on('click', function() {
            changeVisible('$model->id', '$url_visible', $(this));
        })

    })
EOT;

$this->registerJs($js);
?>

    <h3>
        <div class='col-xs-12 col-md-12'>
            <!-- Nombre del tablero -->
            <strong>
                <?=
                    MyHelpers::label(
                        'primary',
                        $model->denominacion
                    )
                ?>
            </strong>

            <!-- Nombre del equipo -->
            <?=
                Html::a(
                    MyHelpers::label(
                        'primary',
                        $model->equipo->denominacion
                    ),
                    ['equipos/view', 'id'=>$model->equipo->id],
                    ['id'=>'link_equipo']
                )
            ?>

            <!-- Botón para añadir a favorito -->
            <?=
                Html::button(
                    MyHelpers::icon('glyphicon glyphicon-star'),
                    [
                        'class'=>'btn btn-md btn-default',
                        'id'=>"btn_favorite_$model->id",
                        'title'=>'Selecciona para marcarlo o desmarcarlo como tablero favorito',
                        'data-toggle'=>"tooltip",
                        'data-placement'=>'right'
                    ]
                )
            ?>

            <?=
                Html::button(
                    MyHelpers::icon(
                        $model->visibilidad->id === 2
                            ? 'glyphicon glyphicon-globe'
                            : 'glyphicon glyphicon-lock'
                    )
                        . ' ' . $model->visibilidad->visibilidad,
                    [
                        'class'=>'btn btn-md btn-default',
                        'id'=>"btn_visibilidad_$model->id"
                    ]
                )
            ?>
        </div>


    </h3>
