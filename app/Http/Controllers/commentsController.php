<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\comments;

class commentsController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'content' => 'required|string|max:255',
        ]);
        
        comments::create($request->all());
        
        return redirect()->back()->with('success', 'Your comment has been submitted successfully!');
    }
    public function index()
    {
        $comments = Comments::all();
        return view('adminDashboard.askus', compact('comments'));
    }

    public function destroy(Comments $comment)
    {
        $comment->delete();
        return redirect()->route('admin.comments.index')->with('success', 'Comment deleted successfully.');
    }
    
}
