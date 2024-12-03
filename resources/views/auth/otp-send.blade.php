@extends('layouts.auth')
@section('title', 'Otp Send')
@section('content')
    <div class="col-md-6">
        <div class="authincation-content">
            <div class="row no-gutters">
                <div class="col-xl-12">
                    <div class="auth-form">
                        <div class="text-center mb-3">
                            <a href="index.html"><img src="{{ asset('dashboard/images/logo-full.png') }}" alt=""></a>
                        </div>
                        <h4 class="text-center mb-4 text-white">Enter your email for get code</h4>
                        <form action="index.html">
                            <div class="form-group">
                                <label class="mb-1 text-white"><strong>Email</strong></label>
                                <input type="email" name="email" id="email" class="form-control"
                                    placeholder="hello@example.com">
                            </div>

                            <div class="text-center">
                                <a onclick="otpSend()" class="btn bg-white text-primary btn-block">Send code</a>
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
        async function otpSend() {
            let email = $('#email').val();
            if (email == '') {
                errorToast('Please enter your email address');
            } else if (!validateEmail(email)) {
                errorToast('Please enter a valid email address');
            } else {
                let url = "{{ route('auth.otp-send') }}";
                showLoader();
                const response = await axios.post(url, {
                    email: email
                });
                hideLoader();
                if (response.data.status == "success") {
                    successToast(response.data.message);
                    setTimeout(() => {
                        window.location.href = response.data.url;
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
