<?php

/* @var $this yii\web\View */
use kartik\tabs\TabsX;
use yii\helpers\Html;

$css = <<<EOT
    .well {
        background-color: #0266a0;
        color: white;
        font-weight: bold;
    }

    a:link {
        text-decoration: none;
    }

    .site-index {
        display: none;
    }

EOT;

$js = <<<EOT
    $('.site-index').fadeIn('slow');
EOT;

$this->registerCss($css);
$this->registerJs($js);
$this->title = Yii::$app->name;

?>
<br><br>
<div class="site-index">
    <!-- Contenido de cabecera -->
    <div class='row'>
        <div class='col-md-4 col-lg-offset-4'>
            <?=
                Html::tag(
                    'h2',
                    Html::img(
                        'images/logotipo.png',
                        ['class'=>'logo-x2', 'alt'=>'logotipo']
                    ) .
                    Html::tag(
                        'strong',
                        Yii::$app->name
                    )
                );
            ?>
        </div>
        <div class='col-xs-7 col-xs-offset-2'>
            <?=
                Html::tag(
                    'strong',
                    Html::tag(
                        'p',
                        'Bienvenidos al la web oficial de MiEspacio, donde
                        teneis la posibilidad de almacenar todo vuestro
                        contenido posible, empezando desde texto hasta archivos,
                        y contenido multimedia.'
                    )
                )
            ?>
        </div>
    </div>
    <hr>
    <br>
    <div class='row'>
        <div class='col-md-offset-1'>
            <div class='col-md-5'>
                <div class='well well-lg'>
                    <p>
                        Se pueden crear espacios de trabajo, que son tableros
                        digitales. En ellos se puede añadir contenido.
                    </p>
                    <p>
                        Permite tener una organización de tareas a realizar en lo
                        largo del tiempo.
                    </p>
                    <p>
                        Te ayuda a tener una planificación correcta de forma
                        cómoda y eficiente.
                    </p>
                </div>
            </div>

            <div class='col-md-5'>
                <div class='well well-lg'>
                    <p>
                        Puedes compartir tus descripciones con los demás y
                        opinar sober ellas.
                    </p>
                    <p>
                        Añade amigos a tus tableros y así poder trabajar
                        en el mismp espacio.
                    </p>
                    <p>
                        Podrás tener toda la información posible guardada
                        en tu espacio de trabajo.
                    </p>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class='row'>
        <div class='col-md-4 col-md-offset-4'>
            <?=
                Html::a(
                    'Iniciar sesión',
                    ['site/login'],
                    ['class'=>'btn-lg btn-success']
                )
            ?>
            &nbsp;
            <?=
                Html::a(
                    'Registrarse',
                    ['usuarios/create'],
                    ['class'=>'btn-lg btn-success']
                )
            ?>
        </div>
    </div>
</div>
