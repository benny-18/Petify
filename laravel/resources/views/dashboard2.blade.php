<!DOCTYPE html>
<html>
<head>
    <title>Dashboard</title>
</head>
<body>
    <h1>Welcome, {{ Auth::user()->firstname }} {{ Auth::user()->lastname }}!</h1>
    <p>You are now logged in!</p>

    @if (session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <h2>Create New Project</h2>
    <form action="{{ route('project.store') }}" method="POST">
        @csrf
        <input type="text" name="title" placeholder="Project Title" required><br>
        <textarea name="description" placeholder="Project Description"></textarea><br>
        <button type="submit">Create Project</button>
    </form>

    <h2>Your Projects</h2>
    @if (Auth::user()->projects->isNotEmpty())
    <ul>
        @foreach (Auth::user()->projects as $project)
            <li>{{ $project->title }} - {{ $project->description }}</li>

        <!-- delete project -->
         <form action="{{ route('project.destroy', $project) }}" method="POST" style="display:inline;">
            @csrf
            @method('DELETE')
            <button type="submit" onclick="return confirm('Delete project?')"">Delete Project</button>
            </form>
        @endforeach
    </ul>
     @else
        <p>You have no projects yet. Start by creating one!</p>
    @endif

    <!-- LOGOUT -->
     <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>