<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>form</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/parsley.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"
        integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
</head>

<body>
    <div class="row mt-5">
        <div class="col-4"></div>
        <div class="card p-4 col-4">
            <h3 class="text-center">Edit Post</h3>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            
            @if (Session::has('alert-success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Success!</strong> {{ Session::get('alert-success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
            <form method="post" action="{{ route('posts.update', $post->id) }}" id="form">
                @csrf
                @method('PATCH')
                <div class="mb-3">
                    <label for="title" class="form-label">Title</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Enter title"
                        value="{{ old('title', $post->title) }}" />
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control" name="description" id="description" placeholder="description">{{ old('description', $post->description) }}</textarea>
                </div>

                <div class="mb-3">
                    <label for="published" class="form-label">Published</label>
                    <select name="is_published" class="form-control" id="published">
                        <option disabled selected>choose option</option>
                        <option @selected(old('is_published', $post->is_published) == 1) value="1">Yes</option>
                        <option @selected(old('is_published', $post->is_published) == 0) value="0">No</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="isactive" class="form-label">isActive</label>
                    <select name="is_active" class="form-control" id="isactive">
                        <option disabled selected>choose option</option>
                        <option @selected(old('is_active', $post->is_active) == 1) value="1">Yes</option>
                        <option @selected(old('is_active', $post->is_active) == 0) value="0">No</option>
                    </select>
                </div>

                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>

    </div>
    <script src="{{ asset('assets/parsley.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>

    <script>
        $('#form').parsley();
    </script>
</body>

</html>
