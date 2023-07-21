<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $table = 'media';


    function entries()
    {
        return $this->morphedByMany(Entry::class, 'media_rel');
    }
    
    function tags()
    {
        return $this->morphedByMany(Tag::class, 'media_rel');
    }

    function users()
    {
        return $this->morphedByMany(User::class, 'media_rel');
    }


}
