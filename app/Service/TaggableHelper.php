<?php

namespace App\Service;


use App\Contracts\Taggable;
use App\Models\Tag;

class TaggableHelper
{
    public function syncTagsFromRequest(Taggable $taggable)
    {
        $taggableTags = $taggable->tags->keyBy('name');
        $newTags = collect(explode(',', request('tags')))->keyBy(function ($item) {
            return trim($item);
        });
        $syncIds = $taggableTags->intersectByKeys($newTags)->pluck('id')->toArray();

        $tagsToCreate = $newTags->diffKeys($taggableTags);
        foreach ($tagsToCreate as $tagName){
            $tag = Tag::firstOrCreate(['name' => $tagName]);
            $syncIds[] = $tag->id;
        }
        $taggable->tags()->sync($syncIds);
    }
}
