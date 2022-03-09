@extends('../layout/template')

@section('body')

    <body>
        @extends('../layout/navbar')
        <div class="container my-5">
            <div class="row">

                <div class="col-md-12">

                    <div class="card">

                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-1">
                                    <a href="{{ url('dashboard') }}" class="btn btn-info  ">Back</a>
                                </div>
                                <div class="col-md-10">
                                    <h3 class="card-title text-center">Category List</h3>
                                </div>

                            </div>

                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($categories as $category)
                                        <tr>
                                            <td>{{ $id++ }}</td>
                                            <td>{{ $category->name }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-2">
                                                        <a href="{{ url('category/edit/' . $category->id) }}"
                                                            class="btn btn-primary">Edit</a>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <form action="{{ url('category/delete/' . $category->id) }}" method="post">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger">Delete</button>
                                                        </form>
                                                    </div>

                                                </div>



                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @section('script')
    @endsection
</body>
@endsection
