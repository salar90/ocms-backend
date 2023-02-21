<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;


    public function tagType()
    {
        return $this->belongsTo(TagType::class);
    }

    public function entries()
    {
        return $this->belongsToMany(Entry::class);
    }
}
