@extends('../layout/template')

@section('body')

    <body>
        @extends('../layout/navbar')

        {{-- BEGIN CONTENT --}}
        <div class="container my-5 mb-5">
            <div class="row">
                @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
            </div>
            <div class="row">
                @foreach ($cars as $car)
                    <div class="col-md-4 mb-5">
                        <div class="card" style="">
                            <img class="card-img-top" src="{{ $car->image }}" alt="Card image cap">
                            <div class="card-body">
                                <h5 class="card-title text-capitalize">{{ $car->name }} - ${{ $car->price }}</h5>
                                <p class="card-text"><strong>Make</strong>: {{ $car->make }} </p>
                                <p class="card-text"><strong>Model</strong>: {{ $car->model }} </p>
                                <p class="card-text"><strong>Registration</strong>: {{ $car->registration }} </p>
                                <p class="card-text"><strong>Engine Size</strong>: {{ $car->engine_size }} </p>
                                <p class="card-text"><strong>Category</strong>: {{ $car->category->name }} </p>
                                <a href="{{ route('add.to.cart', $car->id) }}" class="btn btn-success mr-3">Add to basquet</a>
                                <a href="{{ url('/car', $car->slug )}}" class="btn btn-info">See Details</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        {{-- END CONTENT --}}

    @section('script')
    @endsection
</body>
@endsection
