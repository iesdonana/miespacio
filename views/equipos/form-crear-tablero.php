<?php
/* Formulario para la creación de un tablero */
/* @var $equipos app\models\Equipos */
/* @var $tablero app\models\Tableros */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
?>


<?php $form = ActiveForm::begin([
    'action'=>['tableros/create'],
    'enableAjaxValidation' => true,
]); ?>

    <?= $form->field($tablero, 'denominacion', ['enableAjaxValidation' => true])->textInput(['maxlength' => true]) ?>

    <?= $form->field($tablero, 'equipo_id')->dropdownList([
        'Equipos'=>$equipos,
    ]) ?>

    <?= Html::hiddenInput('usuario_id', Yii::$app->user->id) ?>

    <div class="form-group">
        <?= Html::submitButton('Crear tablero', ['class' => 'btn btn-success btn-block']) ?>
    </div>

<?php ActiveForm::end(); ?>
