<?php

namespace App\Models;

use App\Enums\Status;
use App\Traits\HasStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory;

    use HasStatus;

    const statusList = [
        Status::Draft,
        Status::Published,
    ];
    


    public function tagType()
    {
        return $this->belongsTo(TagType::class);
    }

    public function entries()
    {
        return $this->belongsToMany(Entry::class);
    }
}
