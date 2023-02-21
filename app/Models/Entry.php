<?php

namespace App\Models;

use App\Enums\Status;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Entry extends Model
{
    use HasFactory;

    const statusList = [
        Status::Draft,
        Status::Published,
        Status::Deleted,
    ];

    public static function statusValues()
    {
        return array_map(fn ($status) => $status->value, self::statusList); 
    }

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
