<?php

namespace App\Models;

use App\Service\ModelCacheService;

class Model extends \Illuminate\Database\Eloquent\Model
{

    protected $guarded = [
        'id',
    ];

    protected static function boot()
    {
        parent::boot();

        $modelCacheService = resolve(ModelCacheService::class);
        /**
         * @var ModelCacheService $modelCacheService
         */


        static::saved(function (Model $model) use ($modelCacheService) {
            $modelCacheService->clearListCache($model);
            $modelCacheService->clearItemCache($model);
        });

        static::deleted(function (Model $model) use ($modelCacheService) {
            $modelCacheService->clearListCache($model);
            $modelCacheService->clearItemCache($model);
        });
    }


    public static function getByRouteKeyFromCache($routeKey, $arRelations = [])
    {
        $modelCacheService = resolve(ModelCacheService::class);
        /**
         * @var ModelCacheService $modelCacheService
         */
        $model = new static();
        $cacheTag = $modelCacheService->getItemCacheTag($model, $routeKey);
        $cacheKey = $modelCacheService->getItemCacheKey($model, $arRelations, $routeKey);
        return \Cache::tags($cacheTag)->rememberForever($cacheKey, function () use ($model, $routeKey, $arRelations) {
            $query = static::where($model->getRouteKeyName(), $routeKey);
            if (!empty($arRelations)) {
                $query->with($arRelations);
            }
            return $query->first();
        });
    }
}
