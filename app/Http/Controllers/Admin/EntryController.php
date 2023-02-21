<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Entry;
use App\Traits\HasJsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EntryController extends Controller
{
    use HasJsonResponse;


    public function index()
    {
        $entries = Entry::query()->paginate();
        return $this->jsonResponse($entries);
        return $entries;
    }

    public function store()
    {
        request()->validate([
            'title' => 'required',
            'status' => ['required', Rule::in(Entry::statusValues())],
            'excerpt' => '',
            'content' => 'required',
            'author_id' => 'in:users,id',
            'tags' => 'array,in(tags,id)',
        ]);
        
        $data = request()->only([
            'title',
            'status',
            'excerpt',
            'content',
            'author_id'
        ]);
        $entry = new Entry($data);
        $entry->save();

        if(request()->has('tags')){
            $entry->tags()->attach(request()->input('tags'));
        }
        
        return $this->jsonResponse($entry);
    }

    public function update(Entry $entry)
    {
        request()->validate([
            'title' => 'required',
            'status' => ['required', Rule::in(Entry::statusValues())],
            'excerpt' => '',
            'content' => 'required',
            'author_id' => 'in:users,id',
            'tags' => 'array,in(tags,id)'
        ]);
        
        $entry->update(request()->only([
            'title',
            'status',
            'excerpt',
            'content',
            'author_id'
        ]));

        if(request()->has('tags')){
            $entry->tags()->attach(request()->input('tags'));
        }

        return $this->jsonResponse($entry);
    }


    public function destroy($id)
    {
        $entry = Entry::query()->findOrFail($id);
        $entry->delete();
        return $this->jsonResponse([
            $entry->only(['id', 'title'])
        ], '');
    }
    
}
