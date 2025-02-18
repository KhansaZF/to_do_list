<?php

namespace App\Http\Controllers;

use App\Models\to_dos;
use Illuminate\Http\Request;
use App\Models\ToDo;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ToDoController extends Controller
{
    public function index()
    {
        // Mengambil semua data dari model to_dos,dimana mengambil field user id yg user nya adalah user yg login saat ini
        $todos = to_dos::where('user_id', Auth::id())->get();
        $todos = to_dos::paginate(6);


        // Mengirim data ke view
        return view('todo.index', compact('todos'));
    }
    /** 
     * Show then form for creating a new resource.
     */
     public function create()
     {

        return view('todo.create');
     }
     /**
      * Storage a newly created resource in storage.
      */

     public function store(Request $request)
    {
        $validate = $request->validate([
            'title' =>'required|string',       
            'description' =>'required|string',       
            'status' =>'required|in:pending,done',       
            'image' =>'nullable|mimes:jpg,png,jpeg|max:2048',       
               
        ]);
        if($request->hasFile('image')){
            $gambar = $request->file('image')->store('images','public');
            $validate['image'] = $gambar;
        }

        $validate['user_id'] = Auth::id();

        to_dos::create($validate);

        return redirect()->route('todo.index');
    }
    /**
     * Show the form for editing the specified resource.
     */
public function edit($id)
{
    $todo = to_dos::findOrFail($id);
    return view('todo.edit', compact('todo'));
}

public function update(Request $request, $id)
{
    $todo = to_dos::findOrFail($id);

    $validate = $request->validate([
        'title' =>'required|string',       
        'description' =>'required|string',       
        'status' =>'required|in:pending,done', 
        'image' =>'nullable|mimes:jpg,png,jpeg|max:2048', 
    ]);

    if($request->hasFile('image')){
        if($todo->image){
            Storage::delete('public/' . $todo->image);
        }

        $gambar = $request->file('image')->store('images','public');
        $validate['image'] = $gambar;
    }

    $todo->update($validate);

    return redirect()->route('todo.index');
}

public function destroy($id)
{
    $todo = to_dos::findOrFail($id);

    if($todo->image){
        Storage::delete('public/' . $todo->image);
    }

    $todo->delete();

    return redirect()->route('todo.index');
}

public function show($id)
{
    $todo = to_dos::findOrFail($id);
    return view('todo.show', compact('todo'));
}

    }