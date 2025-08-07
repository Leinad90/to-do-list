<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TodoController extends Controller
{
    public function index()
    {
        $todos = Todo::all();
        return view('todos.index', compact('todos'));
    }

    public function store(Request $request)
    {
        $request->validate(['title' => 'required']);
        $data = $request->all();
        unset($data['_token']);
        Todo::create($data);
        return redirect()->back();
    }

    public function setDone(Request $request)
    {
        $a = DB::table('todos')->where('id','=', $request->input('id'))->update(['completed' => 1]);
        var_dump($a);
        return redirect()->back();
    }

    public function destroy(Request $request)
    {
        $request->validate(['id' => 'required']);
        Todo::destroy($request->get('id'));
        return redirect()->back();
    }
}
