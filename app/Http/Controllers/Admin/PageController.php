<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageController extends Controller
{
    public function index()
    {
        $pages = Page::latest()->paginate(10);
        return view('admin.pages.index', compact('pages'));
    }

    public function show(Page $page)
    {
        return view('admin.pages.show', compact('page'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([ 'title' => 'required', 'content' => 'required' ]);
        
        $page = new Page();
        $page->title = $request->title;
        $page->slug = Str::slug($request->title);
        $page->content = $request->content;
        $page->status = $request->has('status');
        $page->save();

        return redirect()->route('admin.pages.index')->with('success', 'Page created.');
    }

    public function edit(Page $page)
    {
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, Page $page)
    {
        $request->validate([ 'title' => 'required', 'content' => 'required' ]);
        
        $page->title = $request->title;
        if($request->title !== $page->title) $page->slug = Str::slug($request->title);
        $page->content = $request->content;
        $page->status = $request->has('status');
        $page->save();

        return redirect()->route('admin.pages.index')->with('success', 'Page updated.');
    }

    public function destroy(Page $page)
    {
        $page->delete();
        return redirect()->route('admin.pages.index')->with('success', 'Page deleted.');
    }
}
