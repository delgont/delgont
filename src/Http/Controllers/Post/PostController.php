<?php

namespace Stephendevs\Pagman\Http\Controllers\Post;

use Stephendevs\Pagman\Http\Controllers\Controller;
use Illuminate\Http\Request;

use  Stephendevs\Pagman\Models\Post\Post;
use Stephendevs\Pagman\Http\Requests\PostRequest;

use Stephendevs\Pagman\Traits\PostTypeController as MasterPostController;

class PostController extends Controller
{
    use MasterPostController;
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
        $post->author_id = auth()->user()->id;
        $post->updatedby_id = auth()->user()->id;

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
        $post->sp = ($request->post_type != 'post') ? '1' : '0';
        $post->updatedby_id = auth()->user()->id;

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

   

}
