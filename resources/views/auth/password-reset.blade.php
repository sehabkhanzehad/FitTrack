@extends('layouts.auth')
@section('title', 'Sign in')
@section('content')
    <div class="col-md-6">
        <div class="authincation-content">
            <div class="row no-gutters">
                <div class="col-xl-12">
                    <div class="auth-form">
                        <div class="text-center mb-3">
                            <a href="index.html"><img src="{{ asset('dashboard/images/logo-full.png') }}" alt=""></a>
                        </div>
                        <h4 class="text-center mb-4 text-white">Reset Password</h4>
                        <form action="index.html">
                            <div class="form-group">
                                <label class="mb-1 text-white"><strong>New Password</strong></label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="********">
                            </div>
                            <div class="form-group">
                                <label class="mb-1 text-white"><strong>Confirm Password</strong></label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control" placeholder="********">
                            </div>
                            <div class="row ml-1">
                                <div class="form-group">
                                    <div class="custom-control custom-checkbox ml-1 text-white" id="showPassword">
                                        <input type="checkbox" class="custom-control-input" id="show">
                                        <label class="custom-control-label text-white" for="show">Show
                                            Password</label>
                                    </div>
                                </div>
                            </div>


                            <div class="text-center">
                                <a onclick="reset()" class="btn bg-white text-primary btn-block">Reset</a>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        // show password
        document.getElementById('show').addEventListener('change', function() {
            const passwordField = document.getElementById('password');
            const passwordConfirmationField = document.getElementById('password_confirmation');
            if (this.checked) {
                passwordField.type = 'text';
                passwordConfirmationField.type = 'text';
            } else {
                passwordField.type = 'password';
                passwordConfirmationField.type = 'password';
            }
        });

        async function reset() {
            let password = $('#password').val();
            let password_confirmation = $('#password_confirmation').val();

            if (password == "") {
                errorToast("Please enter your password");
            } else if (password_confirmation == "") {
                errorToast("Please confirm your password");
            } else if (password != password_confirmation) {
                errorToast("Password and Confirm Password do not match");
            } else if (password.length < 8) {
                errorToast("Password must be at least 8 characters");
            } else if (!validatePassword(password)) {
                errorToast(
                    "Password must contain at least one uppercase letter, one lowercase letter, one number, and one special character"
                );
            } else {
                let data = {
                    password: password_confirmation,
                };
                let url = "{{ route('auth.reset-pass') }}";
                showLoader();
                const response = await axios.post(url, data);
                hideLoader();

                if (response.data.status == 'success') {
                    successToast(response.data.message);
                    setTimeout(() => {
                        window.location.href = response.data.url;
                    }, 1000);
                } else {
                    errorToast(response.data.message);
                    setTimeout(() => {
                        window.location.href = response.data.url;
                    }, 1000);
                }
            }

            function validatePassword(password) {
                var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/;
                return re.test(password);
            }
        }
    </script>
@endsection
