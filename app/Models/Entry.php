<?php

namespace App\Models;

use App\Enums\Status;
use App\Traits\HasStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory;
    use HasStatus;

    const statusList = [
        Status::Draft,
        Status::Published,
        Status::Deleted,
    ];

    protected $guarded = [];
    protected $fillable = [
        'title',
        'status',
        'excerpt',
        'content',
        'author_id'
    ];

    public function tags()
    {
        return $this->belongsToMany(Tag::class);
    }


}
