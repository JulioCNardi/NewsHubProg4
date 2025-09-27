<?php

namespace app\controllers;

use yii\web\Controller;
use yii\filters\AccessControl;

class DashboardController extends Controller
{
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'only' => ['index'], // restringe a ação index
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'], // apenas usuários logados
                    ],
                ],
            ],
        ];
    }

    public function actionIndex()
    {
        return $this->render('index');
    }
}
