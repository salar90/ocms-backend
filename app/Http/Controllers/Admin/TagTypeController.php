<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\TagType;
use App\Traits\HasJsonResponse;
use Illuminate\Validation\Rule;

class TagTypeController extends Controller
{
    use HasJsonResponse;

    public function index()
    {
        return $this->jsonResponse(TagType::all());
    }

    public function store()
    {
        $this->validate(request(), [
            'name' => 'required|string',
            'status' => ['required', Rule::in(TagType::statusValues())],
            'parents' => Rule::in(['0', '1'])
        ]);

        $tagType = new TagType(request()->only(['name', 'status', 'parents']));
        $tagType->save();

        return $this->jsonResponse($tagType);
    }

    public function update($id)
    {
        $this->validate(request(), [
            'name' => 'required|string',
            'status' => ['required', Rule::in(TagType::statusValues())],
            'parents' => Rule::in(['0', '1']),
        ]);
        
        $tagType = TagType::query()->findOrFail($id);

        $tagType->update(request()->only(['name', 'status', 'parents']));

        return $this->jsonResponse($tagType);
    }

    public function destroy($id)
    {
        $tagType = TagType::findOrFail($id);
        $tagType->tags->each(function($tag){
            $tag->entries()->detach();
            $tag->delete();
        });
        $tagType->delete();
        return $this->jsonResponse(['id' => $id]);
    }


}
