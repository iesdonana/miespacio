<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Iniciar sesión';
$this->params['breadcrumbs'][] = $this->title;


?>

<div class="site-login">
    <!-- Formulario de inicio de sesión -->
    <div class='row'>
        <div class='col-md-6 col-md-offset-3'>
            <div class='panel panel-primary'>
                <div class='panel-heading'>
                    <?=
                        Html::tag(
                            'h3',
                            Html::img(
                                'images/logotipo.png',
                                ['class'=>'logo', 'alt'=>'logotipo']
                            ) .
                            Html::tag(
                                'strong',
                                $this->title
                            )
                        );
                    ?>
                </div>
                <div class='panel-body'>
                    <?php $form = ActiveForm::begin([
                        'id' => 'login-form',
                        'action'=>['site/login'],
                    ]); ?>

                        <!-- Nombre de usuario -->
                        <?= $form->field($model, 'username')->textInput([
                            'placeholder'=>'p. ej.: alberto',
                        ]) ?>

                        <!-- Contraseña -->
                        <?= $form->field($model, 'password')->passwordInput([
                            'placeholder'=>'p. ej.: ·········',
                        ]) ?>

                        <!-- Enlace para recuperación de contraseña -->
                        <?= Html::a(
                            '¿Has olvidado la contraseña?',
                            ['site/solicitar-password'])
                        ?>

                        <!-- Recordar la sesión -->
                        <?= $form->field($model, 'rememberMe')->checkbox() ?>

                        <!-- Botón de envio de formulario -->
                        <?= Html::submitButton('Iniciar sesión', [
                            'class' => 'btn btn-success btn-block',
                            'name' => 'login-button'
                        ]) ?>


                    <?php ActiveForm::end(); ?>
                </div>
            </div>
        </div>
    </div>

</div>
