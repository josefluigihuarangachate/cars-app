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
                                    <h3 class="card-title text-center">Edit Category</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post" id="handleRegisterAjax" action="{{ url('/category/update', $category) }}" name="postform">
                                @method('PATCH')
                                @csrf
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" value="{{ $category->name }}" class="form-control" />
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
