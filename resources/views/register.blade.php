@extends('../layout/template')

@section('body')

    <body class="antialiased">
        @extends('../layout/navbar')

        {{-- BEGIN CONTENT --}}

        <div class="container">
            <div class="my-5">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 offset-md-3">
                            <h3>Register</h3>
                            <form method="post" id="handleRegisterAjax" action="{{ url('do-register') }}" name="postform">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" value="{{ old('name') }}" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" value="{{ old('email') }}" class="form-control" />
                                    @csrf
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" name="password" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <label>Confirm Password</label>
                                    <input type="password" name="confirm_password" class="form-control" />
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary">REGISTER</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>

        {{-- END CONTENT --}}

    @section('script')
        <script>
            $(function() {

                $(document).on("submit", "#handleRegisterAjax", function() {
                    var e = this;

                    $(this).find("[type='submit']").html("REGISTER...");
                    $.post($(this).attr('action'), $(this).serialize(), function(data) {

                        $(e).find("[type='submit']").html("REGISTER");
                        if (data.status) {
                            alert(data.msg)
                            window.location = data.redirect_location;
                        }


                    }).fail(function(response) {

                        // $(e).find("[type='submit']").html("LOGIN");
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
