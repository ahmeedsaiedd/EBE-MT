<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Projects</title>
</head>
<body>
    <div>
        <h1>All Projects</h1>
        <ul>
            @foreach($projects as $project)
                <li>
                    {{ $project->name }}
                </li>
            @endforeach
        </ul>
    </div>
</body>
</html>
