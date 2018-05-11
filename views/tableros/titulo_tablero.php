<?php
/** Vista del título del tablero **/

/* @var $model app\models\Tableros */

use yii\helpers\Html;
use yii\helpers\Url;
use app\components\MyHelpers;

$this->registerJsFile(
    '/js/titulo_tablero.js',
    ['depends'=>[\yii\web\JqueryAsset::className()]]
);

$esFavorito = $model->esFavorito;

$url_favorito = Url::to(['favoritos/create']);
$usuario_id = Yii::$app->user->id;

$js = <<<EOT
    $(document).ready(function() {
        addEventBoton('$model->id', '$esFavorito');

        $(`#btn_favorite_$model->id`).on('click', function() {
            addFavorito('$model->id', '$usuario_id', '$url_favorito');
        })

    })
EOT;

$this->registerJs($js);
?>

<div id='tablero_name' class='col-md-12'>
    <h3>
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

        <?=
            Html::button(
                MyHelpers::icon('glyphicon glyphicon-star'),
                [
                    'class'=>'btn btn-md btn-default',
                    'id'=>"btn_favorite_$model->id"
                ]
            )
        ?>
    </h3>
</div>
