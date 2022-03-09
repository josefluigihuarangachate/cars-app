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
                                    <a href="{{ url('dashboard') }}" class="btn btn-info   ">Back</a>
                                </div>
                                <div class="col-md-10">
                                    <h3 class="card-title text-center">Edit Car</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post" id="handleRegisterAjax" action="{{ url('/car/update', $car) }}"
                                name="postform">
                                @method('PATCH')
                                @csrf
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" value="{{ $car->name }}" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Price</label>
                                    <input type="text" name="price" value="{{ $car->price }}" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Make</label>
                                    <input type="text" name="make" value="{{ $car->make }}" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Model</label>
                                    <input type="text" name="model" value="{{ $car->model }}" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Registration</label>
                                    <input type="text" name="registration" value="{{ $car->registration }}"
                                        class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Engine Size</label>
                                    <input type="text" name="engine_size" value="{{ $car->engine_size }}"
                                        class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Category </label>
                                    <select class="form-control" name="category_id">
                                        <option value="{{ $car->category_id }}" selected>{{ $car->category->name }}
                                        </option>
                                        @foreach ($categories as $category)
                                            @if ($car->category_id != $category->id)
                                                <option class="options" value="{{ $category->id }}">
                                                    {{ $category->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">EDIT</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @section('script')
        <script>
            $(function() {

                $(document).on("submit", "#handleRegisterAjax", function() {
                    var e = this;

                    $(this).find("[type='submit']").html("SAVE...");
                    $.post($(this).attr('action'), $(this).serialize(), function(data) {

                        $(e).find("[type='submit']").html("SAVE");
                        if (data.status) {
                            alert(data.msg)
                            window.location = data.redirect_location;
                        }


                    }).fail(function(response) {
                        $(".alert").remove();
                        var erroJson = JSON.parse(response.responseText);
                        for (var err in erroJson) {
                            for (var errstr of erroJson[err])
                                $("[name='" + err + "']").after("<div class='alert alert-danger'>" +
                                    errstr + "</div>");
                        }

                    });
                    return false;
                });

            });
        </script>
    @endsection
</body>
@endsection
