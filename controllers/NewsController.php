<?php

namespace app\controllers;

use yii\web\Controller;
use Yii;
use app\models\NewsService;
use app\models\NewsHistory;

class NewsController extends Controller
{
    public function actionLatest()
    {
        $newsData = NewsService::getLatest();
        return $this->render('@app/views/site/news', [
            'news' => $newsData,
        ]);
    }

    public function actionSearch()
    {
        $query = Yii::$app->request->get('q');
        $page = (int) Yii::$app->request->get('page', 1);

        $newsData = null;

        if (!empty($query)) {
            $newsData = \app\models\NewsService::search($query, $page);
        }

        return $this->render('@app/views/site/search', [
            'news' => $newsData['articles'] ?? [],
            'query' => $query,
            'currentPage' => $newsData['currentPage'] ?? 1,
            'totalPages' => $newsData['pages'] ?? 1,
        ]);
    }

    public function actionIndex($page = 1, $country = 'Brazil')
    {
        $newsData = NewsService::latest($page, $country);
        return $this->render('@app/views/site/news', [
            'news' => $newsData['articles'] ?? [],
            'currentPage' => $newsData['currentPage'] ?? 1,
            'totalPages' => $newsData['totalPages'] ?? 1,
            'country' => $country,
        ]);
    }

    public function actionHistory()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        $history = NewsHistory::getUserHistory(50);
        
        return $this->render('@app/views/site/history', [
            'history' => $history,
        ]);
    }

    public function actionTrackClick()
    {
        if (Yii::$app->user->isGuest) {
            return $this->asJson(['success' => false, 'message' => 'Usuário não logado']);
        }

        $title = Yii::$app->request->post('title');
        $url = Yii::$app->request->post('url');
        $description = Yii::$app->request->post('description', '');

        if (empty($title) || empty($url)) {
            return $this->asJson(['success' => false, 'message' => 'Dados inválidos']);
        }

        $success = NewsHistory::saveClick($title, $url, $description);
        
        return $this->asJson([
            'success' => $success,
            'message' => $success ? 'Clique registrado' : 'Erro ao registrar clique'
        ]);
    }

    public function actionClearHistory()
    {
        if (Yii::$app->user->isGuest) {
            return $this->redirect(['site/login']);
        }

        $success = NewsHistory::clearUserHistory();
        
        if ($success) {
            Yii::$app->session->setFlash('success', 'Histórico limpo com sucesso!');
        } else {
            Yii::$app->session->setFlash('error', 'Erro ao limpar histórico.');
        }

        return $this->redirect(['news/history']);
    }
}
