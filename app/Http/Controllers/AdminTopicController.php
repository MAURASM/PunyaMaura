<?php

namespace App\Http\Controllers;

use App\Models\Topic;
use Illuminate\Http\Request;
use Cviebrock\EloquentSluggable\Services\SlugService;

class AdminTopicController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.topics.index', [
            'title' => 'Topics',
            'topics' => Topic::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.topics.create', [
            'title' => 'Create New Topic',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|unique:topics',
            'slug' => 'required|unique:topics'
        ]);

        Topic::create($validatedData);

        return redirect('/admin/topics')->with('success', 'New topic has been created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Topic $topic)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Topic $topic)
    {
        return view('admin.topics.edit', [
            'title' => 'Edit Topic',
            'topic' => $topic
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Topic $topic)
    {
        $rules = [
            'name' => 'required|unique:topics',
            'slug' => 'required|unique:topics'
        ];

        $validatedData = $request->validate($rules);

        Topic::where('id', $topic->id)
            ->update($validatedData);

        return redirect('/admin/topics')->with('success', 'Topic has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Topic $topic)
    {
        Topic::destroy($topic->id);

        return redirect('/admin/topics')->with('success', 'Topic has been deleted!');
    }

    public function checkSlug(Request $request)
    {
        $slug = SlugService::createSlug(Topic::class, 'slug', $request->name);
        return response()->json(['slug' => $slug]);
    }
}
