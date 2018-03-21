<?php

namespace app\controllers;

use Yii;
use app\models\Equipos;
use app\models\EquiposSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\data\ActiveDataProvider;
use yii\widgets\ActiveForm;
use yii\web\Response;
use app\models\Tableros;

/**
 * EquiposController implements the CRUD actions for Equipos model.
 */
class EquiposController extends Controller
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
        ];
    }

    /**
     * Se muestran los tableros creados en cada equipo. Se permite poder crear
     * un tablero nuevo o un nuevo equipo.
     * @param integer $id_equipo El identificador del equipo.
     * @return mixed
     */
    public function actionGestionarTableros($id_equipo = null)
    {
        $equipos = new ActiveDataProvider([
            'query'=>Equipos::find(),
        ]);

        $tableroCrear = new Tableros([
            'equipo_id'=>$id_equipo,
        ]);

        if (Yii::$app->request->isAjax && $tableroCrear->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($tableroCrear);
        }

        if ($tableroCrear->load(Yii::$app->request->post()) && $tableroCrear->save()) {
            return $this->redirect(['tableros/view', 'id'=>$tableroCrear->id]);
        }

        return $this->render('gestionar', [
            'equipos' => $equipos,
            'tableroCrear'=> $tableroCrear,
            'equipoCrear'=> new Equipos(),
        ]);
    }

    /**
     * Displays a single Equipos model.
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
     * Creates a new Equipos model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $equipo = new Equipos([
            'usuario_id'=>Yii::$app->user->id,
        ]);

        $tablero = new Tableros();

        $equipos = Equipos::find()
            ->select(['denominacion'])
            ->indexBy('id')
            ->column();

        if (Yii::$app->request->isAjax && $equipo->load(Yii::$app->request->post())) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return ActiveForm::validate($equipo);
        }

        if ($equipo->load(Yii::$app->request->post()) && $equipo->save()) {
            return $this->redirect(['view', 'id' => $equipo->id]);
        }

        return $this->render('create', [
            'equipo' => $equipo,
            'equipos'=>$equipos,
            'tablero'=>$tablero,
        ]);
    }

    /**
     * Updates an existing Equipos model.
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
     * Deletes an existing Equipos model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Equipos model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Equipos the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Equipos::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
