<?php

namespace app\controllers;

use yii\web\Controller;
use Yii;
use app\models\NewsService;

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
}
