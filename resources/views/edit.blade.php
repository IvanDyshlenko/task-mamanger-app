<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>
<body>
<div class="container">
    <form method="POST" action="{{ url('/edit') }}">
        @csrf
        @if ($id) <input type="hidden" name="_method" value="PATCH"> @endif
        @if ($id == null)
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" id="name" name="username">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" class="form-control" id="email" placeholder="name@example.com" name="email">
        </div>
        @endif
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" rows="4" name="description">{{ $description }}</textarea>
        </div>
        @if ($id)
        <input type="hidden" name="id" value="{{ $id }}"/>
        <div class="form-check">
            <input class="form-check-input" type="checkbox" id="is_done" name="is_done"
                @if ($is_done == 1)
                    checked
                @endif
            >
            <label class="form-check-label" for="is_done">
                Is Done
            </label>
        </div>
        @endif
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>
</body>
</html>
