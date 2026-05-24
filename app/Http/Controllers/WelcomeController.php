<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category; // Wajib di-import
use App\Models\Partner;  // Wajib di-import

class WelcomeController extends Controller
{
    public function index()
    {
        // Mengambil semua data kategori dan partner dari database
        $categories = Category::latest()->get();
        $partners = Partner::latest()->get();

        // Melempar data ke resources/views/welcome.blade.php
        return view('welcome', compact('categories', 'partners'));
    }
}