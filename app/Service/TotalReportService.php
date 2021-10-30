<?php


namespace App\Service;


use App\Models\Comment;
use App\Models\Model;
use App\Models\NewsItem;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;

class TotalReportService
{

    public function getEntitiesArray()
    {
        return [
            'newsItem' => [
                'checkboxTitle' => 'Новости',
                'reportTitle' => 'Новостей',
                'modelClass' => NewsItem::class,
            ],
            'post' => [
                'checkboxTitle' => 'Статьи',
                'reportTitle' => 'Статей',
                'modelClass' => Post::class,
            ],
            'comment' => [
                'checkboxTitle' => 'Комментарии',
                'reportTitle' => 'Новостей',
                'modelClass' => Comment::class,
            ],
            'tag' => [
                'checkboxTitle' => 'Теги',
                'reportTitle' => 'Тегов',
                'modelClass' => Tag::class,
            ],
            'user' => [
                'checkboxTitle' => 'Пользователи',
                'reportTitle' => 'Пользователей',
                'modelClass' => User::class,
            ],
        ];
    }


    /**
     * @param $entityKey
     * @return Model | null
     */
    public function getModel($entityKey)
    {
        $entities = $this->getEntitiesArray();
        $modelClass = $entities[$entityKey]['modelClass'] ?? null;
        return ($modelClass && class_exists($modelClass)) ? (new $modelClass) : null;
    }


    public function getReportTitle($entityKey)
    {
        $entities = $this->getEntitiesArray();
        return $entities[$entityKey]['reportTitle'] ?? null;
    }
}
