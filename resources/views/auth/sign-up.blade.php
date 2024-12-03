@extends('layouts.auth')
@section('title', 'Sign Up')
@section('content')
    <div class="col-md-8">
        <div class="authincation-content">
            <div class="row no-gutters">
                <div class="col-xl-12">
                    <div class="auth-form">

                        <div class="text-center mb-3">
                            <a href="javascript:void(0);"><img src="{{ asset('dashboard/images/logo-full.png') }}"
                                    alt=""></a>
                        </div>

                        <h4 class="text-center mb-4 text-white">Create your account</h4>
                        <form action="">

                            <div class="row">
                                <div class="col-md-12 col-sm-12 ">
                                    <div class="form-group">
                                        <label class="mb-1 text-white"><strong>Name</strong></label>
                                        <input type="text" name="name" id="name" class="form-control"
                                            placeholder="John Doe">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-12 ">
                                    <div class="form-group">
                                        <label class="mb-1 text-white"><strong>Email</strong></label>
                                        <input type="email" name="email" id="email" class="form-control"
                                            placeholder="hello@example.com">
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12 ">
                                    <div class="form-group">
                                        <label class="mb-1 text-white"><strong>Phone</strong></label>
                                        <input type="text" name="phone" id="phone" class="form-control"
                                            placeholder="+012 345 6789">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-12 ">
                                    <div class="form-group">
                                        <label class="mb-1 text-white"><strong>Date of
                                                Birth</strong></label>
                                        <input type="date" name="dob" id="dob" class="form-control">
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12 ">
                                    <div class="form-group">
                                        <label class="mb-1 text-white"><strong>Gender</strong></label>
                                        <select class="form-control custom-select bg-white" name="gender" id="gender">
                                            <option value="">Select Gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                            <option value="other">Other</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-12 ">
                                    <div class="form-group">
                                        <label class="mb-1 text-white"><strong>Height (ft)</strong></label>
                                        <input type="text" name="height" id="height" class="form-control"
                                            placeholder="0.00">
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12 ">
                                    <div class="form-group">
                                        <label class="mb-1 text-white"><strong>Weight (kg)</strong></label>
                                        <input type="text" name="weight" id="weight" class="form-control"
                                            placeholder="000">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6 col-sm-12 ">
                                    <div class="form-group">
                                        <label
                                            class="mb-1 text-white d-flex justify-content-between"><strong>Password</strong></label>
                                        <input type="password" name="password" id="password" class="form-control"
                                            placeholder="********">
                                    </div>
                                </div>

                                <div class="col-md-6 col-sm-12 ">
                                    <div class="form-group">
                                        <label class="mb-1 text-white"><strong>Confirm
                                                Password</strong></label>
                                        <input type="password" name="password_confirmation" id="password_confirmation"
                                            class="form-control" placeholder="********">
                                    </div>
                                </div>


                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12 ">
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox" id="showPassword">
                                            <input type="checkbox" class="custom-control-input" id="show">
                                            <label class="custom-control-label text-white" for="show">Show
                                                Password</label>
                                        </div>
                                    </div>

                                </div>

                            </div>

                            <div class="text-center mt-4">
                                <a onclick="signUp()" class="btn btn-primary text-white btn-block"
                                    style="border: 1px solid #fff;">Create</a>
                            </div>

                        </form>

                        <div class="new-account mt-3 text-center">
                            <p class="text-white">Already have an account? <a class="text-white"
                                    style="text-decoration: underline;" href="{{ route('auth.sign-in-page') }}">Sign
                                    in</a></p>
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
            const confirmPasswordField = document.getElementById('password_confirmation');
            if (this.checked) {
                passwordField.type = 'text';
                confirmPasswordField.type = 'text';
            } else {
                passwordField.type = 'password';
                confirmPasswordField.type = 'password';
            }
        });

        async function signUp() {
            let name = $("#name").val();
            let email = $("#email").val();
            let phone = $("#phone").val();
            let dob = $("#dob").val();
            let gender = $("#gender").val();
            let height = $("#height").val();
            let weight = $("#weight").val();
            let password = $("#password").val();
            let password_confirmation = $("#password_confirmation").val();


            // if (name == "" || email == "" || phone == "" || dob == "" || gender == "" || height == "" || weight == "" ||
            //     password == "" || password_confirmation == "") {
            //     errorToast("Please fill all fields");
            // }

            if (name == "") {
                errorToast("Please enter your name");
            } else if (name.length < 3) {
                errorToast("Name must be at least 3 characters");
            } else if (name.length > 50) {
                errorToast("Name must not be more than 50 characters");
            } else if (!validateName(name)) {
                errorToast("Name must contain only alphabets");
            } else if (email == "") {
                errorToast("Please enter your email address");
            } else if (!validateEmail(email)) {
                errorToast("Please enter a valid email address");
            } else if (phone == "") {
                errorToast("Please enter your phone number");
            } else if (phone.length < 11) {
                errorToast("Phone number must be at least 11 digits");
            } else if (!validatePhoneNumber(phone)) {
                errorToast("Please enter a valid phone number");
            } else if (isNaN(phone)) {
                errorToast("Phone number must be numeric");
            } else if (dob == "") {
                errorToast("Please select your date of birth");
            } else if (gender == "") {
                errorToast("Please select your gender");
            } else if (height == "") {
                errorToast("Please enter your height");
            } else if (height < 0) {
                errorToast("Height must be greater than 0");
            } else if (isNaN(height)) {
                errorToast("Height must be numeric");
            } else if (weight == "") {
                errorToast("Please enter your weight");
            } else if (weight < 0) {
                errorToast("Weight must be greater than 0");
            } else if (isNaN(weight)) {
                errorToast("Weight must be numeric");
            } else if (password == "") {
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
                    name: name,
                    email: email,
                    phone: phone,
                    dob: dob,
                    gender: gender,
                    height: height,
                    weight: weight,
                    password: password_confirmation,
                };

                let url = "{{ route('auth.sign-up') }}";

                showLoader();
                const response = await axios.post(url, data);
                hideLoader();

                if (response.data.status == "success") {
                    successToast(response.data.message);
                    setTimeout(() => {
                        window.location.href = response.data.url;
                        // reload page
                        // location.reload();
                    }, 1000);
                } else {
                    errorToast(response.data.message);
                }
            }
        }

        function validateName(name) {
            var re = /^[a-zA-Z\s]*$/;
            return re.test(name);
        }

        function validateEmail(email) {
            var re = /\S+@\S+\.\S+/;
            return re.test(email);
        }

        function validatePassword(password) {
            var re = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[a-zA-Z]).{8,}$/;
            return re.test(password);
        }

        function validatePhoneNumber(phone) {
            var re = /^[0-9\-\+]*$/;
            return re.test(phone);
        }
    </script>
@endsection
