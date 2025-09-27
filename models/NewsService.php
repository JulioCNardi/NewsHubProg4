<?php

namespace app\models;

use Yii;

class NewsService
{
    private static function getApiKey()
    {
        return getenv('API_KEY');
    }

    /**
     * Busca notícias por palavra-chave
     *
     * @param string $query
     * @param int $page
     * @param int $pageSize
     * @return array
     */
    public static function search($query, $page = 1, $pageSize = 12)
    {
        $apiKey = trim(getenv('API_KEY')); // garante que não tenha espaços
        $query = urlencode($query);

        $url = "https://content.guardianapis.com/search?q={$query}"
             . "&page={$page}&page-size={$pageSize}"
             . "&api-key=" . urlencode($apiKey)
             . "&show-fields=thumbnail,trailText,webUrl";

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
     * @param string $country
     * @param string $category
     * @return array
     */
    public static function latest($page = 1, $country = 'Brazil', $category = null)
    {
        $apiKey = trim(getenv('API_KEY')); // garante que não tenha espaços
        $pageSize = 12;
        $query = urlencode($country);

        $url = "https://content.guardianapis.com/search?q={$query}"
             . "&page={$page}&page-size={$pageSize}"
             . "&api-key=" . urlencode($apiKey)
             . "&show-fields=thumbnail,headline,trailText,short-url";

        // Adicionar filtro de categoria se especificado
        if ($category && $category !== 'all') {
            $url .= "&section=" . urlencode($category);
        }

        $response = @file_get_contents($url);
        if ($response === false) {
            return ['error' => 'Falha ao conectar à API'];
        }

        $data = json_decode($response, true);

        $articles = [];
        if (isset($data['response']['results'])) {
            foreach ($data['response']['results'] as $item) {
                $articles[] = [
                    'title' => $item['webTitle'] ?? 'Sem título',
                    'description' => $item['fields']['trailText'] ?? '',
                    'url' => $item['webUrl'] ?? '#',
                    'thumbnail' => $item['fields']['thumbnail'] ?? '',
                ];
            }
        }

        return [
            'articles' => $articles,
            'currentPage' => $data['response']['currentPage'] ?? 1,
            'totalPages' => $data['response']['pages'] ?? 1,
        ];
    }

    /**
     * Obtém as categorias disponíveis na API
     *
     * @return array
     */
    public static function getCategories()
    {
        return [
            'all' => 'Todas as categorias',
            'world' => 'Mundo',
            'politics' => 'Política',
            'sport' => 'Esportes',
            'technology' => 'Tecnologia',
            'business' => 'Negócios',
            'science' => 'Ciência',
            'culture' => 'Cultura',
            'lifestyle' => 'Estilo de vida',
            'opinion' => 'Opinião',
            'environment' => 'Meio ambiente',
            'health' => 'Saúde',
            'education' => 'Educação',
            'travel' => 'Viagem',
            'food' => 'Culinária',
        ];
    }
}
 