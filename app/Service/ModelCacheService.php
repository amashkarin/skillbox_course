<?php


namespace App\Service;


use App\Models\Model;

class ModelCacheService
{
    public function clearListCache(Model $model)
    {
        return \Cache::tags(static::getListCacheTag($model))->flush();
    }

    public function clearItemCache(Model $model)
    {
        $routeKey = $model->getAttribute($model->getRouteKeyName());
        return \Cache::tags(static::getItemCacheTag($model, $routeKey))->flush();
    }

    public function getCachePrefix(Model $model)
    {
        $arClassNameParts = explode('/', get_class($model)) ?? [];
        return strtolower(array_pop($arClassNameParts));
    }


    public function getListCacheTag(Model $model)
    {
        return static::getCachePrefix($model) . '_list';
    }


    public function getListCacheKey(Model $model, array $additionalKeys = [])
    {
        $arKeys = array_merge([
            static::getListCacheTag($model),
            request('page') ?? 1,
        ], $additionalKeys);

        return implode('|', $arKeys);

    }


    public function getItemCacheTag(Model $model, $routeKey = null)
    {
        return static::getCachePrefix($model) . '_' . ($routeKey ?: $model->getRouteKey());
    }


    public function getItemCacheKey(Model $model, $arRelations = [], $routeKey = null)
    {


        return $this->getItemCacheTag($model, $routeKey)  . implode('|', $arRelations);
    }
}
