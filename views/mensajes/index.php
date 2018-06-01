<?php
/* Listado completo de mensajes */

use yii\helpers\Html;
use app\components\MyHelpers;

/* @var $mensajes_enviados yii\db\ActiveRecord */
/* @var $mensajes_recibidos yii\db\ActiveRecord */

$this->title = 'Mensajes';
$this->params['breadcrumbs'][] = $this->title;

$num_recibidos = $mensajes_recibidos->count();
$num_enviados = $mensajes_enviados->count();

$items = [
    [
        //  Mensajes Recibidos
        'label'=> MyHelpers::icon('glyphicon glyphicon-inbox') .
            ' ' . '<strong>Recibidos</strong>' . ' ' .
            MyHelpers::badge($num_recibidos),
        'content'=> $this->render('mensajes_recibidos', [
            'mensajes_recibidos'=>$mensajes_recibidos,
        ]),
    ],

    [
        //  Mensajes Enviados
        'label'=> MyHelpers::icon('glyphicon glyphicon-send') .
            ' ' . '<strong>Enviados</strong>',
        'content'=> $this->render('mensajes_enviados', [
            'mensajes_enviados'=>$mensajes_enviados,
        ]),
    ],

    [
        //  Crear mensaje
        'label'=> MyHelpers::icon('glyphicon glyphicon-pencil') .
            ' ' . '<strong>Redactar</strong>',
        'content'=>$this->render('create', [
            'nuevo_mensaje'=>$nuevo_mensaje,
            'datos'=>$datos,
        ])
    ]
];


?>

<?= MyHelpers::tabs($items); ?>
