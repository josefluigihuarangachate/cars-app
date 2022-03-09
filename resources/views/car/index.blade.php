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
                                    <h3 class="card-title text-center">Car List</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Make</th>
                                        <th>Model</th>
                                        <th>Registration</th>
                                        <th>Engine Size</th>
                                        <th>Category</th>
                                        <th>Options</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($cars as $car)
                                        <tr>
                                            <td>{{ $id++ }}</td>
                                            <td>{{ $car->name }}</td>
                                            <td>{{ $car->price }}</td>
                                            <td>{{ $car->make }}</td>
                                            <td>{{ $car->model }}</td>
                                            <td>{{ $car->registration }}</td>
                                            <td>{{ $car->engine_size }}</td>
                                            <td>{{ $car->category->name }}</td>
                                            <td>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <a href="{{ url('car/edit/' . $car->id) }}"
                                                            class="btn btn-primary">Edit</a>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <form action="{{ url('car/delete/' . $car->id) }}" method="post">
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
