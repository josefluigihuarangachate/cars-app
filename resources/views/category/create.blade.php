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
                                    <h3 class="card-title text-center">New Category</h3>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post" id="handleRegisterAjax" action="{{ url('/category/store') }}" name="postform">
                                @csrf
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">SAVE</button>
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
