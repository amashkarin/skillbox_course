<?php

namespace App\Http\Controllers;

use App\Models\NewsItem;
use App\Models\Post;
use App\Models\User;


class StatisticController extends Controller
{
    public function index()
    {
        $title = 'Сатистика сайта';

        $postCount = \Cache::tags(Post::getListCacheTag())->rememberForever('postCount', function () {
            return Post::count('id');
        });

        $newsCount = \Cache::tags(NewsItem::getListCacheTag())->rememberForever('newsCount', function () {
            return NewsItem::count('id');
        });

        $mostWritableAuthor = \Cache::tags(Post::getListCacheTag())->rememberForever('maxLengthPost', function () {
            return User::withCount('posts')->orderByDesc('posts_count')->first()->name;
        });

        $maxLengthPost = \Cache::tags(Post::getListCacheTag())->rememberForever('maxLengthPost', function () {
            $post = Post::select(['title', 'slug'])->selectRaw('LENGTH(body) as body_length')->orderBy('body_length', 'desc')->first();
            return '<a href="' . route('posts.show', $post) . '">' . $post->title . '</a> (длина ' . $post->body_length . ' символов)' ;
        });

        $minLengthPost = \Cache::tags(Post::getListCacheTag())->rememberForever('minLengthPost', function () {
            $post = Post::select(['title', 'slug'])->selectRaw('LENGTH(body) as body_length')->orderBy('body_length', 'asc')->first();
            return '<a href="' . route('posts.show', $post) . '">' . $post->title . '</a> (длина ' . $post->body_length . ' символов)' ;
        });

        $avgPostsByOwners = \Cache::tags(Post::getListCacheTag())->rememberForever('avgPostsByOwners', function () {
            $subQuery = Post::select(['owner_id'])->selectRaw('count(*) as posts_count')->groupBy('owner_id');
            return Post::fromSub($subQuery, 'subQuery')->average('posts_count');
        });


        $maxHistoryRows = \Cache::tags(Post::getListCacheTag())->rememberForever('maxHistoryRows', function () {
            $post = Post::select(['title', 'slug'])->withCount('history')->orderBy('history_count', 'desc')->first();
            return '<a href="' . route('posts.show', $post) . '">' . $post->title . '</a> (количество изменений ' . $post->history_count . ')' ;
        });

        $mostCommentablePost = \Cache::tags(Post::getListCacheTag())->rememberForever('mostCommentablePost', function () {
            $post = Post::select(['title', 'slug'])->withCount('comments')->orderBy('comments_count', 'desc')->first();
            return '<a href="' . route('posts.show', $post) . '">' . $post->title . '</a> (количество комментариев ' . $post->comments_count . ')' ;
        });

        $statistic = collect([
            [
                'title' => 'Общее количество статей',
                'value' => $postCount,
            ],
            [
                'title' => 'Общее количество новостей',
                'value' => $newsCount,
            ],
            [
                'title' => 'ФИО автора, у которого больше всего статей на сайте',
                'value' => $mostWritableAuthor
            ],
            [
                'title' => 'Самая длинная статья',
                'value' => $maxLengthPost,
            ],
            [
                'title' => 'Самая короткая статья',
                'value' => $minLengthPost,
            ],
            [
                'title' => 'Средние количество статей у активных пользователей',
                'value' => $avgPostsByOwners,
            ],
            [
                'title' => 'Самая непостоянная статья',
                'value' => $maxHistoryRows,
            ],
            [
                'title' => 'Самая обсуждаемая статья — название, ссылка на статью, у которой больше всего комментариев.',
                'value' => $mostCommentablePost,
            ],
        ]);

        return view('statistic.index', compact('title', 'statistic'));
    }
}
