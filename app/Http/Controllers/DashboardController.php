<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use App\Models\Visit;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Get the count of articles
        $articleCount = Post::count();

        // Get the count of users
        $userCount = User::count();

        // Get the count of visits in the last month
        $visitCount = Visit::where('created_at', '>=', Carbon::now()->subMonth())->count();

        // Pass the counts to the view
        return view('admin.dashboard', compact('articleCount', 'userCount', 'visitCount'));
    }
}
