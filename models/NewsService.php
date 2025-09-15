<?php

namespace app\models;

use Yii;

class NewsService
{
    private static $apiKey = "46618e1b-3ea4-4481-9950-95dba05cae34";

    /**
     * Busca notícias por palavra-chave
     *
     * @param string $query
     * @param int $page
     * @param int $pageSize
     * @return array
     */
    public static function search($query, $page = 1, $pageSize = 10)
    {
        $url = "https://content.guardianapis.com/search?q=" . urlencode($query) .
               "&show-fields=thumbnail,trailText,webUrl&page={$page}&page-size={$pageSize}&api-key=" . self::$apiKey;

        $response = @file_get_contents($url);
        if ($response === false) {
            return ['error' => 'Não foi possível conectar à API externa.'];
        }

        $data = json_decode($response, true);

        if (!isset($data['response']['results'])) {
            return [];
        }

        $articles = [];
        foreach ($data['response']['results'] as $item) {
            $articles[] = [
                'title' => $item['webTitle'] ?? 'Sem título',
                'url' => $item['webUrl'] ?? '#',
                'description' => $item['fields']['trailText'] ?? '',
                'thumbnail' => $item['fields']['thumbnail'] ?? '',
            ];
        }

        return [
            'articles' => $articles,
            'currentPage' => $data['response']['currentPage'] ?? 1,
            'totalPages' => $data['response']['pages'] ?? 1,
        ];
    }

    /**
     * Busca últimas notícias automaticamente
     *
     * @param int $page
     * @param int $pageSize
     * @return array
     */
    public static function latest($page = 1, $pageSize = 10)
    {
        $url = "https://content.guardianapis.com/search?show-fields=thumbnail,trailText,webUrl&page={$page}&page-size={$pageSize}&api-key=" . self::$apiKey;

        $response = @file_get_contents($url);
        if ($response === false) {
            return ['error' => 'Não foi possível conectar à API externa.'];
        }

        $data = json_decode($response, true);

        if (!isset($data['response']['results'])) {
            return [];
        }

        $articles = [];
        foreach ($data['response']['results'] as $item) {
            $articles[] = [
                'title' => $item['webTitle'] ?? 'Sem título',
                'url' => $item['webUrl'] ?? '#',
                'description' => $item['fields']['trailText'] ?? '',
                'thumbnail' => $item['fields']['thumbnail'] ?? '',
            ];
        }

        return [
            'articles' => $articles,
            'currentPage' => $data['response']['currentPage'] ?? 1,
            'totalPages' => $data['response']['pages'] ?? 1,
        ];
    }
}
