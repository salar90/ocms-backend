<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Entry;
use App\Traits\HasJsonResponse;
use Illuminate\Http\Request;

class EntryController extends Controller
{
    use HasJsonResponse;


    public function index()
    {
        $entries = Entry::query()->paginate();
        if(request()->wantsJson()){
            return $entries;
        }
    }

    public function store()
    {
        $data = request()->only([
            'title',
            'status',
            'excerpt',
            'content',
            'author_id'
        ]);
        $entry = new Entry($data);
        $entry->save();
        
        return $this->jsonResponse($entry);

    }
    
}
