<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Models\TagType;
use App\Traits\HasJsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TagController extends Controller
{
    use HasJsonResponse;

    public function index(Request $request)
    {
        $filters = $request->input('filters');
        $query = Tag::query();
        
        if($filters['search'] ?? null){
            $query->where('name', 'like', '%' . $filters['search'] . '%');
        }

        if($filters['type'] ?? null){
            $query->whereIn('tagType', (array)$filters['type']);
        }

        $result = $query->paginate();

        return $this->jsonResponse($result);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'sometimes',
            'tag_type_id' => ['required', Rule::in(TagType::all()->pluck('id'))],
        ]);

        $tag = new Tag($request->only(['title', 'content', 'tag_type_id']));

        $tag->save();

        return $this->jsonResponse($tag);
    }

    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'title' => 'required|string',
            'content' => 'sometimes',
        ]);

        $tag->update($request->only(['title', 'content']));

        return $this->jsonResponse($tag);
    }

    public function destroy($id)
    {
        $tag = Tag::query()->findOrFail($id);
        $tag->entries()->detach();
        $tag->delete();
        return $this->jsonResponse($tag);
    }

}
