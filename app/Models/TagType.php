<?php

namespace App\Models;

use App\Enums\Status;
use App\Traits\HasStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagType extends Model
{
    use HasFactory;
    use HasStatus;

    protected $guarded = [];

    const statusList = [
        Status::Active,
        Status::Inactive,
    ];


    public function tags()
    {
        return $this->hasMany(Tag::class);
    }
}
