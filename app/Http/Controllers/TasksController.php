<?php

namespace App\Http\Controllers;
use App\Models\Tasks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TasksController extends Controller
{
   public function index()
    {
        $tugas = Tasks::latest()->paginate(10);
        return view('home', compact('tugas'));
    }
public function create()
{
    return view('create');
}
public function store(Request $request)
{
    $this->validate($request, [
        'image'     => 'required|image|mimes:png,jpg,jpeg',
        'nama'      => 'required',
        'deskripsi' => 'required',
        'status'    => 'required'
    ]);

    // Ambil user_id dari pengguna yang saat ini login
    $user_id = auth()->user()->id;

    //upload image
    $image = $request->file('image');
    $image->storeAs('public/tasks', $image->hashName());

    $task = Tasks::create([
        'user_id'   => $user_id, // Masukkan user_id pengguna yang saat ini login
        'image'     => $image->hashName(),
        'nama'      => $request->nama,
        'deskripsi' => $request->deskripsi,
        'status'    => $request->status
    ]);

    if($task){
        //redirect dengan pesan sukses
        return redirect()->route('home')->with(['success' => 'Data Tugas Berhasil Disimpan!']);
    } else {
        //redirect dengan pesan error
        return redirect()->route('home')->with(['error' => 'Data Tugas Gagal Disimpan!']);
    }
}
public function markAsDone(Tasks $task)
{
    $task->update(['status' => 1]);

    return response()->json(['message' => 'Tugas berhasil ditandai sebagai selesai']);
}
}