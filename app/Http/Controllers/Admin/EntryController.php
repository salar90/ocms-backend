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
        ]);
        
        $entry->update(request()->only([
            'title',
            'status',
            'excerpt',
            'content',
            'author_id'
        ]));

        return $this->jsonResponse($entry);
    }


    public function destroy($id)
    {
        Entry::query()->delete($id);
        return $this->jsonResponse('', '');
    }
    
}
