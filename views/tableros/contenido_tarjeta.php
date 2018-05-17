<?php

/** Contenido de la tarjeta */

/* @var $tarjeta app\models\Tarjetas */
/* @var $adjunto app\models\Adjuntos */

use app\components\MyHelpers;
use yii\helpers\Html;
use app\models\Miembros;

$miembro = Miembros::find()
    ->where([
        'equipo_id'=>$tarjeta->lista
            ->tablero->equipo->id,
        'usuario_id'=>Yii::$app->user->id
    ])->one();

?>
<!-- Modal contenido tarjeta -->
<?php MyHelpers::modal_begin(
        MyHelpers::icon('glyphicon glyphicon-info-sign') .
        ' ' . '<strong>Contenido de tarjeta</strong>',
        MyHelpers::icon('glyphicon glyphicon-eye-open'),
        'btn btn-xs btn-default',
        $tarjeta->id
); ?>

    <?= $this->render('/tarjetas/view',[
        'model' => $tarjeta,
        'adjunto'=>$adjunto
    ]) ?>

<?php MyHelpers::modal_end() ?>

<?php if ($miembro->esPropietario): ?>
    <!-- Botón de eliminar tarjeta -->
    <?=
        Html::button(
            MyHelpers::icon('glyphicon glyphicon-remove'),
            [
                'class'=>'btn btn-xs btn-default',
                'id'=>"btn_delete_tarjeta_$tarjeta->id",
            ]
        );
    ?>

<?php endif; ?>
