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
                        <h4 class="text-center mb-4 text-white">Enter code for verify</h4>
                        <form action="index.html">
                            <div class="form-group">
                                <label class="mb-1 text-white"><strong>Code</strong></label>
                                <input type="text" name="code" id="code" class="form-control"
                                    placeholder="Enter code">
                            </div>

                            <div class="text-center">
                                <a onclick="otpVerify()" class="btn bg-white text-primary btn-block">Verify</a>
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
        async function otpVerify() {
            let code = $('#code').val();
            if (code == '') {
                errorToast('Please enter your code');
            } else if (code.length != 6) {
                errorToast('Please enter a valid code');
            } else {
                let url = "{{ route('auth.otp-verify') }}";
                showLoader();
                const response = await axios.post(url, {
                    code: code
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
        }
    </script>
@endsection
