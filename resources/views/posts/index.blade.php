<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>posts</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <style>
        #outer {
            text-align: center;
        }

        .inner {
            display: inline-block;
        }
    </style>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('assets/css/toastr.min.css') }}">
    {{-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.css"> --}}
</head>

<body>
    <div class="row mt-5">
        <div class="col-3"></div>
        <div class="p-4 col-6">
            <h3 class="text-center">Posts</h3>
            <a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Create Post</a>
            @if (count($posts) > 0)
                <table class="table table-hover table-bordered">
                    <thead>
                        <tr>
                            <th scope="col">ID</th>
                            <th scope="col">Title</th>
                            <th scope="col">Description</th>
                            <th scope="col">Publish</th>
                            <th scope="col">Active</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $post)
                            <tr>
                                <td>{{ $post->id }}</td>
                                <td>{{ $post->title }}</td>
                                <td>{{ Str::limit($post->description, '10', '...') }}</td>
                                <td>{{ $post->is_published == 1 ? 'Yes' : 'No' }}</td>
                                <td>{{ $post->is_active == 1 ? 'Yes' : 'No' }}</td>
                                <td id="outer">
                                    <a href="{{ route('posts.show', $post->id) }}" class="btn btn-success inner"><i class="fa fa-eye"></i></a>
                                    <a href="{{ route('posts.edit', $post->id) }}" class="btn btn-primary inner"><i class="fa fa-edit"></i></a>
                                    <form class="inner" method="post" action="{{ route('posts.destroy', $post->id) }}">
                                      @csrf
                                      @method('DELETE')
                                        <button class="btn btn-danger"><i class="fa fa-trash"></i></button>
                                    </form>
                                    @if($post->trashed())
                                        <a href="{{ route('posts.soft-delete', $post->id) }}" class="btn btn-warning inner"><i class="fa fa-undo"></i></a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <h4 class="text-center text-danger">No Record found</h4>
            @endif

            {{-- {{ $posts->render('pagination::bootstrap-5') }} --}}
            {{-- {{ $posts->links('pagination::bootstrap-5') }} --}}
            {{ $posts->links() }}

        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous">
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    <script src="{{ asset('assets/js/toastr.min.js') }}"></script>
    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.1.4/toastr.min.js"></script> --}}


    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>

    <script>
        @if (Session::has('alert-success'))
            toastr["success"]("{{ Session::get('alert-success') }}");

        @elseif (Session::has('alert-danger'))
            toastr["success"]("{{ Session::get('alert-danger') }}");

        @elseif (Session::has('alert-info'))
            toastr["info"]("{{ Session::get('alert-info') }}");

        @elseif (Session::has('alert-message'))
            toastr["success"]("{{ Session::get('alert-message') }}");
        @endif
    </script>
</body>

</html>
