<?php

use yii\helpers\Html;
use yii\helpers\Url;
use Yii;

$css = <<<EOT
    
    .cabecera {
        background-color: blue;
        color: white;
    }

    .cuerpo {
        background-color: white;
    }
EOT;

$this->registerCss($css);

?>

<div class='contenedor'>
    <div class='cabecera'>
        <?=
            Html::tag(
                'h2',
                'Confirmar el correo electrónico nuevo
                 de ' . Yii::$app->name
            );

        ?>
    </div>
    <div class='cuerpo'>
        <?=
            Html::tag(
                'p',
                'Ha enviado una solicitud para añadir
                 el correo electrónico a su cuenta'
            )
        ?>

        <?=
            Html::a('Click aqui', ['site/index'])
        ?>
    </div>
</div>
