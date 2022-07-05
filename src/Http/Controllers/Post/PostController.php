<?php

namespace Delgont\Cms\Http\Controllers\Post;

use Delgont\Cms\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Delgont\Cms\Models\Post\Post;
use Delgont\Cms\Models\Category\Category;

use Delgont\Cms\Http\Requests\PostRequest;

class PostController extends Controller
{
    /**
    * Display a listing of the posts by its type.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $posts = Post::orderBy('created_at', 'desc')->paginate(5);
        $postsTrashCount = Post::onlyTrashed()->count();
        return (request()->expectsJson()) ? response()->json(['posts' =>$posts, 'postsTrashCount' => $postsTrashCount]) : view('delgont::posts.index', compact(['posts']));
    }

    public function create()
    {
        $standard_posts = $this->postTypes();
        $categories = Category::all();

        return (request()->expectsJson()) ? response()->json($standard_posts, $categories) : view('delgont::posts.create', compact(['standard_posts', 'categories']));
    }



    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
        $request->validated();

        $post = new Post();
        $post->post_title = $request->post_title;
        $post->post_key = str_replace(' ', '-', $request->post_title);
        $post->extract_text = $request->extract_text;
        $post->post_content = $request->post_content;
        $post->post_type = $request->post_type;
        $post->sp = ($request->post_type != 'post') ? '1' : '0';
        $post->created_by = auth()->user()->id;
        $post->updated_by = auth()->user()->id;

        # Dertermine if request has file (post featured image)
        $post->post_featured_image = ($request->hasFile('post_featured_image')) ? 'storage/'.request()->post_featured_image->store(config('pagman.media_dir', 'media/featuredimages'), 'public') : null;

        $post->save();
        
        # Check if request has icon
        if($request->hasFile('post_icon')){
            $post->icon()->create([
                'icon' => 'storage/'.request()->post_icon->store(config('pagman.media_dir', 'media'), 'public')
            ]);
        }
        
        return ($request->expectsJson()) ? response()->json(['success' => true,'message' => 'Post Created Successfully',], 200) : back()->withInput()->with('created', 'Post Created Successfully');
    }

    public function show($id)
    {
        $standard_posts = $this->postTypes();
        $categories = Category::all();
        $post = Post::with(['categories'])->findOrFail($id);
        return (request()->expectsJson()) ? response()->json($post, $standard_posts) : view('delgont::posts.show', compact(['standard_posts', 'post']));

    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'post_title' => 'required|unique:posts,post_title,'.$id,
            'post_type' => 'required',
            'extract_text' => 'nullable|min:3|max:200',
            'post_featured_image' => 'nullable|mimes:jpeg,png,jpg|max:2048'
        ]);

       $post = Post::with('author:id,name')->findOrFail($id);

        $post->post_title = $request->post_title;
        $post->extract_text = $request->extract_text;
        $post->post_content = (is_array($request->post_content)) ? json_encode($request->post_content) : $request->post_content;
        $post->post_type = $request->post_type;
        //$post->sp = ($request->post_type != 'post') ? '1' : '0';
        $post->updated_by = auth()->user()->id;

        //dertermine if request has file
        ($request->hasFile('post_featured_image'))
        ? $post->post_featured_image = 'storage/'.request()->post_featured_image->store(config('pagman.media_dir', 'media/featuredimages'), 'public')
        : '';

        $post->save();
        $post->categories()->sync($request->category);

        //check if request has icon
        if($request->hasFile('post_icon')){
            $post->icon()->updateOrCreate([
                'icon' => 'storage/'.request()->post_icon->store(config('pagman.media_dir', 'media'), 'public')
            ]);
        }
        return ($request->expectsJson()) ? response()->json(['success' => true,'message' => 'Post Updated Successfully'], 200) : back()->withInput()->with('updated', 'Post Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Post::destroy($id);
        return back()->with('deleted', 'Post deleted successfully');
    }



    private function postTypes() : array
    {
        return config(config('delgont.web', 'web').'.post_types', []);
    }
   

}
