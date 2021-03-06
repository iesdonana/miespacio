<?php

namespace app\controllers;

use Yii;
use app\models\Mensajes;
use app\models\MensajesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use app\models\UsuariosSearch;
use yii\widgets\ActiveForm;
use yii\web\Response;
use app\models\DatosUsuarios;
use yii\db\Expression;
use yii\filters\AccessControl;

/**
 * MensajesController implements the CRUD actions for Mensajes model.
 */
class MensajesController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],

            'access'=>[
                'class'=>AccessControl::className(),
                'only'=>['index', 'create'],
                'rules'=>[
                    [
                        'allow'=>true,
                        'actions'=>['index', 'create'],
                        'roles'=>['@'],
                    ],
                    [
                        'allow'=>true,
                        'actions'=>['index', 'create'],
                        'roles'=>['@'],
                    ]
                ],
            ]
        ];
    }

    public function actionLoadMensajes()
    {
        $mensajes = Yii::$app->user->identity
            ->getMensajes0();

        return $this->renderAjax('lista_mensajes', [
            'mensajes_recibidos'=>$mensajes,
        ]);
    }

    /**
     * Muestra todos los mensajes.
     * @return mixed
     */
    public function actionIndex()
    {
        $mensajes_enviados = Yii::$app->user->identity
            ->getMensajes()
            ->with('emisor0');


        $mensajes_recibidos = Yii::$app->user->identity
            ->getMensajes0()
            ->with('receptor0');

        //  Mensajes reciidos sin leer.
        $num_recibidos = Mensajes::find()
            ->where([
                'view_at'=>null,
                'receptor'=>Yii::$app->user->id,
            ])
            ->count();


        //  Usuarios para enviar mensaje.
        $datos = DatosUsuarios::find()
            ->select([
                "CONCAT(nombre_completo, ' ', apellidos,
                    ' (', u.nombre, ') ')"
                ])
            ->joinWith('usuario u')
            ->indexBy('usuario_id')
            ->column();

        return $this->render('index-mensajes', [
            'mensajes_enviados'=>$mensajes_enviados,
            'mensajes_recibidos'=>$mensajes_recibidos,
            'num_recibidos'=>$num_recibidos,
            'nuevo_mensaje'=>new Mensajes(),
            'datos'=>$datos,
        ]);
    }

    /**
     * Displays a single Mensajes model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Mensajes model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Mensajes();

        if (Yii::$app->request->isAjax && $model->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($model);
        }

        if ($model->load(Yii::$app->request->post()) && $model->save()) {

            Yii::$app->session->setFlash(
                'success',
                'Se ha enviado el mensaje correctamente'
            );

            return $this->redirect(['mensajes/index']);
        }

    }

    /**
     * Updates an existing Mensajes model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    /**
     * Lectura de contenido de un mensaje.
     * @param  integer $id ID de mensaje.
     * @return integer Número de mensajes sin leer y recibidos.
     */
    public function actionReadMensaje($id)
    {
        $model = $this->findModel($id);

        $model->view_at = new Expression('current_timestamp');
        $model->save();

        Yii::$app->response->format = Response::FORMAT_JSON;
        return $num_mensajes = Mensajes::find()
            ->where([
                'receptor'=>Yii::$app->user->id,
                'view_at'=>null,
            ])->count();

    }

    public function actionLoadRecibidos()
    {
        $actual = new Expression("current_timestamp - '5 seconds'::INTERVAL ");

        $mensajes_nuevos = Mensajes::find()
            ->andWhere(['>', 'created_at', $actual])
            ->all();


        $mensajes_recibidos = Yii::$app->user->identity
            ->getMensajes0()
            ->with('receptor0');

        return $this->renderAjax('lista_mensajes', [
            'query'=>$mensajes_recibidos,
        ]);
    }

    /**
     * Deletes an existing Mensajes model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();


    }

    /**
     * Finds the Mensajes model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Mensajes the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Mensajes::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
