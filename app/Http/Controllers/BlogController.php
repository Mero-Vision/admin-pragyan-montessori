<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with('media')->where('status', 'active')->latest()->get();
       
        return view('blog.blogs',compact('blogs'));
    }


    public function create()
    {
       
        return view('blog.add_blogs');
    }

    public function show($slug)
    {
        $blog = Blog::with('media')->where('slug', $slug)->first();
       
        return view('admin.blogs.blog_details', compact('blog', 'lang'));
    }

    public function destroy($id)
    {

        $blog = Blog::find($id);

        $blog->clearMediaCollection('blog_image');
        $blog->delete();
        return back()->with('success', 'Blog deleted successfully!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => ['required','max:255'],
            'description' => ['required'],
            'blog_image' => ['required', 'image','max:2024']

        ]);
        try {

            $blog = DB::transaction(function () use ($request) {
                $blog = Blog::create([
                    'published_by' => auth()->user()->name,
                    'title' => $request->title,
                    'description' => $request->Input('description')

                ]);

                if ($request->blog_image) {
                    $blog->addMedia($request->blog_image)->toMediaCollection('blog_image');
                }
                return $blog;
            });
            if ($blog) {
                return back()->with('success', 'Blog published successfully!');
            }
        } catch (\Exception $e) {
            return back()->with('error', $e->getMessage());
        }
    }
}