<?php

namespace app\controllers;

use Yii;
use app\models\User;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\AccessControl;

class UserController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['update', 'delete'],
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'], // somente logados
                    ],
                ],
            ],
        ];
    }

    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model->scenario = User::SCENARIO_UPDATE;

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Conta atualizada com sucesso!');
            return $this->redirect(['dashboard/index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }


    public function actionDelete($id)
    {
        if ($id != Yii::$app->user->id) {
            throw new NotFoundHttpException('Você não pode deletar outro usuário.');
        }

        $this->findModel($id)->delete();
        Yii::$app->user->logout();
        Yii::$app->session->setFlash('info', 'Sua conta foi deletada com sucesso.');
        return $this->redirect(['site/index']);
    }

    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('Usuário não encontrado.');
    }
}
