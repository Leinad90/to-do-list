<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;

class TodoController extends Controller
{
    public function index(): View
    {
        $todos = Todo::all();
        return view('todos.index', compact('todos'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->validate(['title' => ['required','string']]);
        $data = $request->all();
        unset($data['_token']);
        Todo::create($data); //@phpstan-ignore argument.type
        return redirect()->back();
    }

    public function setDone(Request $request): RedirectResponse
    {
        $request->validate(['id' => ['required','integer']]);
        $a = DB::table('todos')->where('id','=', $request->input('id'))->update(['completed' => 1]);
        var_dump($a);
        return redirect()->back();
    }

    public function destroy(Request $request): RedirectResponse
    {
        $request->validate(['id' => ['required','integer']]);
        Todo::destroy((int)$request->get('id')); //@phpstan-ignore cast.int
        return redirect()->back();
    }
}
