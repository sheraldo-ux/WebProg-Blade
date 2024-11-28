<?php

namespace App\Http\Controllers;

use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NewsController extends Controller
{
    public function index()
    {
        $news = News::latest()->get();
        return view('news', compact('news'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|min:5|max:255',
            'content' => 'required|min:10'
        ]);

        News::create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'user_id' => Auth::user()->id
        ]);

        return redirect()->route('news.index')->with('success', 'News posted successfully!');
    }
}
