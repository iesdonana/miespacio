<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>

<!-- Formulario para restablecer nueva contraseña -->
<?php $form = ActiveForm::begin() ?>

    <!-- Contraseña -->
    <?=
        $form->field($model, 'password')->passwordInput()
            ->label('Nueva contraseña')
    ?>

    <!-- Contraseña a repetir -->
    <?=
        $form->field($model, 'password_repeat')->passwordInput()
            ->label('Nueva contraseña (otra vez)')
    ?>

    <!-- Botón de envio de formulario -->
    <?= Html::submitButton('Enviar', ['class'=>'btn btn-success btn-block'])?>

<?php ActiveForm::end() ?>
