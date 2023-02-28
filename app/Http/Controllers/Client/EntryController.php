<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Entry;
use App\Traits\HasJsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

    public function show(Entry $entry)
    {
        return $this->jsonResponse([
            'entry' => $entry,
            'user' => Auth::user()?->id
        ]);
    }
    
}
