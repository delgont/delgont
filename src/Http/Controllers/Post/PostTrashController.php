<?php

namespace Delgont\Cms\Http\Controllers\Post;

use Delgont\Cms\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Delgont\Cms\Models\Post\Post;
use Delgont\Cms\Models\Category\Category;

class PostTrashController extends Controller
{
    
    public function index()
    {
        return Post::onlyTrashed()->count();
        return $posts = Post::onlyTrashed()->orderBy('deleted_at', 'desc')->paginate(5);
        return (request()->expectsJson()) ? response()->json($posts) : view('delgont::posts.trash.index', compact(['posts']));
    }

    public function show($id)
    {
        return Post::onlyTrashed()->findOrFail($id);
    }

}
