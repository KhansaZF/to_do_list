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
        $todos = to_dos::where('user_id', Auth::id())->with('user')->orderBy('created_at', 'desc')->paginate(5);
        
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
    if ($todo->user_id !== Auth::id()){
        return redirect()->route('todo.index')->with('error', 'Anda tidak memiliki izin untuk mengedit To-Do ini.');
    }
    return view('todo.edit', compact('todo'));
}

public function update(Request $request, $id)
{
    $todo = to_dos::findOrFail($id);

    // Cek apakah To-Do ini milik user yang sedang login
    if ($todo->user_id !== Auth::id()) {
        return redirect()->route('todo.index')->with('error', 'Anda tidak memiliki izin untuk mengedit To-Do ini.');
    }

    $validate = $request->validate([
        'title'       => 'required|string',       
        'description' => 'required|string',       
        'status'      => 'required|in:pending,done', 
        'image'       => 'nullable|mimes:jpg,png,jpeg|max:2048', 
    ]);

    if ($request->hasFile('image')) {
        if ($todo->image) {
            Storage::delete('public/' . $todo->image);
        }
        $gambar = $request->file('image')->store('images', 'public');
        $validate['image'] = $gambar;
    }

    $todo->update($validate);

    return redirect()->route('todo.index')->with('success', 'To-Do berhasil diperbarui!');
}


public function destroy($id)
{
    $todo = to_dos::findOrFail($id);

    // Cek apakah To-Do ini milik user yang sedang login
    if ($todo->user_id !== Auth::id()) {
        return redirect()->route('todo.index')->with('error', 'Anda tidak memiliki izin untuk menghapus To-Do ini.');
    }

    if ($todo->image) {
        Storage::delete('public/' . $todo->image);
    }

    $todo->delete();

    return redirect()->route('todo.index')->with('success', 'To-Do berhasil dihapus!');
}


public function show($id)
{
    $todo = to_dos::findOrFail($id);
    return view('todo.show', compact('todo'));
}
public function home()
{
    $completedTodos = to_dos::where('status', 'done')->latest()->get();
    return view('home', compact('completedTodos'));
}


    }