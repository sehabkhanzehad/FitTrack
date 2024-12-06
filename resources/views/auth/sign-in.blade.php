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
                        <h4 class="text-center mb-4 text-white">Sign in your account</h4>
                        <form action="index.html">
                            <div class="form-group">
                                <label class="mb-1 text-white"><strong>Email</strong></label>
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="hello@example.com">
                            </div>
                            <div class="form-group">
                                <label class="mb-1 text-white"><strong>Password</strong></label>
                                <input type="password" name="password" id="password" class="form-control"
                                    placeholder="********">
                            </div>

                            <div class="form-row d-flex justify-content-between mt-4 mb-2">
                                <div class="form-group">
                                    {{-- <div class="custom-control custom-checkbox ml-1 text-white">
                                    <input type="checkbox" class="custom-control-input"
                                        id="basic_checkbox_1">
                                    <label class="custom-control-label" for="basic_checkbox_1">Remember
                                        my preference</label>
                                </div> --}}
                                    <div class="custom-control custom-checkbox ml-1 text-white" id="showPassword">
                                        <input type="checkbox" class="custom-control-input" id="show">
                                        <label class="custom-control-label text-white" for="show">Show
                                            Password</label>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <a href="{{ route('auth.otp-send-page') }}" class="text-white" href="">Forgot
                                        Password?</a>
                                </div>

                            </div>
                            <div class="text-center">
                                <a onclick="signIn()" class="btn bg-white text-primary btn-block">Sign
                                    in</a>
                            </div>
                        </form>
                        <div class="new-account mt-3">
                            <p class="text-white">Don't have an account? <a class="text-white"
                                    href="{{ route('auth.sign-up-page') }}">Sign up</a></p>
                        </div>
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
            if (this.checked) {
                passwordField.type = 'text';
            } else {
                passwordField.type = 'password';
            }
        });

        async function signIn() {
            let email = $("#email").val();
            let password = $("#password").val();

            if (email == "") {
                errorToast("Please enter your email address");
            } else if (!validateEmail(email)) {
                errorToast("Please enter a valid email address");
            } else if (password == "") {
                errorToast("Please enter your password");
            } else {
                let data = {
                    email: email,
                    password: password,
                };

                let url = "{{ route('auth.sign-in') }}";

                showLoader();
                const response = await axios.post(url, data);
                hideLoader();

                if (response.data.status == "success") {
                    successToast(response.data.message);
                    setTimeout(() => {
                        if(response.data.role === "admin"){
                            window.location.href = response.data.urlForAdmin;
                        }
                        if(response.data.role === "user"){
                            window.location.href = response.data.urlForUser;
                        }
                    }, 1000);
                } else {
                    errorToast(response.data.message);
                }


            }

            function validateEmail(email) {
                var re = /\S+@\S+\.\S+/;
                return re.test(email);
            }
        }
    </script>
@endsection
