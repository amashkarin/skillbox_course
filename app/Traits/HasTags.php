<?php


namespace App\Traits;

use App\Models\Tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphToMany;


trait HasTags
{
    public function tags(): MorphToMany
    {
        /**
         * @var $this Model
         */
        return $this->morphToMany(Tag::class, 'taggable');
    }
}
