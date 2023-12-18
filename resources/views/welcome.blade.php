<!DOCTYPE html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet"/>
    <link rel="stylesheet" href="	https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>
<body style="background-color: #f3fdf3">

<div class="container">
    <div class="w-100 text-center my-5">
        <div class="btn-group" role="group" aria-label="Basic radio toggle button group">
            <input type="radio" class="btn-check" {{ (request()->is('/')) ? 'checked' : '' }}>
            <label class="btn btn-outline-secondary">Step 1</label>

            <input type="radio" class="btn-check" {{ (request()->is('step-two')) ? 'checked' : ''  }}>
            <label class="btn btn-outline-secondary">Step 2</label>

            <input type="radio" class="btn-check" {{ (request()->is('step-three')) ? 'checked' : ''  }}>
            <label class="btn btn-outline-secondary">Step 3</label>

            <input type="radio" class="btn-check" {{ (request()->is('review')) ? 'checked' : ''  }}>
            <label class="btn btn-outline-secondary">Review</label>
        </div>
    </div>
    @yield('content')
</div>


</body>
</html>
