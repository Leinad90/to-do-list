<!DOCTYPE html>
<html>
<head>
    <title>ToDo List</title>
</head>
<body>
<h1>ToDo List</h1>
<form action="{{ route('todos.store') }}" method="POST">
    @csrf
    <fieldset><legend>Nový úkol</legend><br>
    Ukol: <input type="text" name="title" required><br>
    Popisek: <textarea name="description"></textarea><br>
    <button type="submit">Přidat</button>
    </fieldset>
</form>
<table>
    <thead>
        <tr>
            <th>Ukol</th>
            <th>Popisek</th>
            <th>Zadáno</th>
            <th>Hotovo</th>
            <th>Smazat</th>
        </tr>
    </thead>
    @foreach ($todos as $todo)
        <tr>
            <th>{{ $todo->title }}</th>
            <td>{{ $todo->description }}</td>
            <td>{{ $todo->created_at }}</td>
            <td>{{ $todo->completed?"Hotovo":$todo->updated_at }}
                @if(!$todo->completed)
                <form action="{{ route('todos.setDone') }}" method="POST" style="display:inline;">
                    @csrf
                    @method('PUT')
                    <input type="hidden" name="id" value="{{$todo->id}}">
                    <button type="submit">Nastavit hotový</button>
                </form>
                @endif
            </td>
            <td>
                <form action="{{ route('todos.destroy') }}" method="POST" onsubmit="return confirm('Opravdu smazat?')" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="id" value="{{$todo->id}}">
                    <button type="submit" style="background-color: red">Smazat</button>
                </form>
            </td>
        </tr>
    @endforeach
</table>
</body>
</html>
