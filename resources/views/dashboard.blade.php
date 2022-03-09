@extends('../layout/template')

@section('body')

    <body>
        @extends('../layout/navbar')

        {{-- BEGIN CONTENT --}}

        <div class="container">
            <div class="my-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6  ">
                            <div class="card text-center">
                                <div class="card-header">
                                    CAR'S
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title mb-5">Total: {{ $cars->count() }}</h5>
                                    <a href="{{ url('car/create') }}" class="btn btn-success mr-3">Car New</a>
                                    <a href="{{ url('cars') }}" class="btn btn-info">Car List</a>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-6  ">
                            <div class="card text-center">
                                <div class="card-header ">
                                    CATEGORIES
                                </div>
                                <div class="card-body">
                                    <h5 class="card-title mb-5">Total: {{ $categories->count() }}</h5>
                                    <a href="{{ url('category/create') }}" class="btn btn-success mr-3">Category New</a>
                                    <a href="{{ url('categories') }}" class="btn btn-info">Category List</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        {{-- END CONTENT --}}

    @section('script')
    @endsection
</body>
@endsection
