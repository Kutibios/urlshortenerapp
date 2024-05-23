<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Url;
use Illuminate\Support\Str;

class UrlController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function store(Request $request)
    {
        $request->validate([
            'original_url' => 'required|url'
        ]);

        $originalUrl = $request->input('original_url');
        $existingUrl = Url::where('original_url', $originalUrl)->first();

        if ($existingUrl) {
            return view('welcome', ['shortened_url' => url($existingUrl->shortened_url)]);
        }

        $shortenedUrl = Str::random(12);
        Url::create([
            'original_url' => $originalUrl,
            'shortened_url' => $shortenedUrl
        ]);

        return view('welcome', ['shortened_url' => url($shortenedUrl)]);
    }

    public function redirect($shortenedUrl)
{
    $url = Url::where('shortened_url', $shortenedUrl)->first();

    if (!$url) {
        abort(404); // Eğer URL bulunamazsa 404 hatası gönderin
    }

    return redirect($url->original_url);
}

}

