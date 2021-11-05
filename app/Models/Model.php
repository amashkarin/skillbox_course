<?php

namespace App\Models;

class Model extends \Illuminate\Database\Eloquent\Model
{

    protected $guarded = [
        'id',
    ];

    protected static function boot()
    {
        parent::boot();

        if (property_exists(static::class, 'cacheList') && static::$cacheList) {

            $clearListCache = function ($model) {
                \Cache::tags([
                    static::getListCacheTag(),
                    static::getItemCacheTag($model->getRouteKey()),
                ])->flush();

            };

            static::saved(function (Model $model) use ($clearListCache) {
                $clearListCache($model);
            });

            static::deleted(function (Model $model) use ($clearListCache) {
                $clearListCache($model);
            });
        }

        if (property_exists(static::class, 'cacheItem') && static::$cacheItem) {

            $clearItemCache = function ($model) {
                $routeKey = $model->getAttribute($model->getRouteKeyName());
                $tag = static::getItemCacheTag($routeKey);
                \Cache::tags($tag)->flush();
            };

            static::saved(function (Model $model) use ($clearItemCache) {
                $clearItemCache($model);
            });

            static::deleted(function (Model $model) use ($clearItemCache) {
                $clearItemCache($model);
            });
        }
    }


    public static function getCachePrefix()
    {
        $arClassNameParts = explode('/', static::class) ?? [];
        return strtolower(array_pop($arClassNameParts));
    }


    public static function getListCacheTag()
    {
        return static::getCachePrefix() . '_list';
    }


    public static function getListCacheKey(array $additionalKeys = [])
    {
        $arKeys = array_merge([
            static::getListCacheTag(),
            request('page') ?? 1,
        ], $additionalKeys);

        return implode('|', $arKeys);
    }

    public static function getItemCacheTag($routeKey)
    {
        return static::getCachePrefix() . '_' . $routeKey;
    }

    public static function getByRouteKeyFromCache($routeKey, $arRelations = [])
    {
        $cacheTag = static::getItemCacheTag($routeKey);
        $cacheKey = $cacheTag . implode('|', $arRelations);
        return \Cache::tags($cacheTag)->rememberForever($cacheKey, function () use ($routeKey, $arRelations) {
            $routeKeyName = (new static())->getRouteKeyName();
            $query = static::where($routeKeyName, $routeKey);
            if (!empty($arRelations)){
                $query->with($arRelations);
            }
            return $query->first();
        });
    }
}
