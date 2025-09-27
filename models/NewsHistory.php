<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;

class NewsHistory extends ActiveRecord
{
    public static function tableName()
    {
        return 'news_history';
    }

    public function rules()
    {
        return [
            [['user_id', 'title', 'url', 'clicked_at'], 'required'],
            [['user_id'], 'integer'],
            [['title', 'url', 'description'], 'string'],
            [['clicked_at'], 'safe'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'Usuário',
            'title' => 'Título',
            'url' => 'URL',
            'description' => 'Descrição',
            'clicked_at' => 'Data do Clique',
        ];
    }

    /**
     * Salva um clique de notícia no histórico
     */
    public static function saveClick($title, $url, $description = '')
    {
        if (Yii::$app->user->isGuest) {
            return false;
        }

        $history = new self();
        $history->user_id = Yii::$app->user->id;
        $history->title = $title;
        $history->url = $url;
        $history->description = $description;
        $history->clicked_at = date('Y-m-d H:i:s');

        return $history->save();
    }

    /**
     * Busca o histórico de cliques do usuário
     */
    public static function getUserHistory($limit = 20)
    {
        if (Yii::$app->user->isGuest) {
            return [];
        }

        return self::find()
            ->where(['user_id' => Yii::$app->user->id])
            ->orderBy(['clicked_at' => SORT_DESC])
            ->limit($limit)
            ->all();
    }

    /**
     * Limpa o histórico do usuário
     */
    public static function clearUserHistory()
    {
        if (Yii::$app->user->isGuest) {
            return false;
        }

        return self::deleteAll(['user_id' => Yii::$app->user->id]);
    }
}
