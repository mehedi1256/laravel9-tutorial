<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>posts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
</head>

<body>
    <div class="row mt-5">
        <div class="col-3"></div>
        <div class="p-4 col-6">
            <h3 class="text-center">Post</h3>
            @if ($post)
            <span><b>Title:</b>{{ $post->title }}</span> <br/>
            <span><b>Description:</b>{{ $post->description }}</span> <br/>
            <span><b>Publish:</b>{{ $post->is_published == 1 ? 'Yes' : 'No' }}</span> <br/>
            <span><b>Active:</b>{{ $post->is_active ==1 ? 'Yes' : 'No' }}</span> <br/>
            @else
            <h4 class="text-center">No post found</h4>
            @endif
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>
</body>

</html>
