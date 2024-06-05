@extends('Auth.layouts.main')

@section('judul', 'Register')

@section('contentAuth')
    <div class="container d-flex justify-content-center align-items-center min-vh-100">
        <!----------------------- Login Container -------------------------->
       <div class="row border rounded-5 p-3 bg-white shadow box-area">
        <!--------------------------- Left Box ----------------------------->
        <div class="col-md-6 rounded-4 d-flex justify-content-center align-items-center flex-column left-box" style="background: #103cbe;">
            <div class="featured-image mb-3">
                <img src="{{asset('assets/img/1.png')}}" class="img-fluid" style="width: 250px;">
            </div>
            <p class="text-white fs-2" style="font-family: 'Courier New', Courier, monospace; font-weight: 600;">Be Verified</p>
            <small class="text-white text-wrap text-center" style="width: 17rem;font-family: 'Courier New', Courier, monospace;">Join experienced Designers on this platform.</small>
        </div> 
        <!-------------------- ------ Right Box ---------------------------->
        <div class="col-md-6 right-box">
            
            <div class="row align-items-center">
                <div class="header-text mb-4">
                    <h2>Hello</h2>
                    <p>We are happy to have you back.</p>
                </div>
                <div class="show-success-alert"></div>
                <form action="#" id="register-form" method="POST">
                    @csrf
                    <div class="input-group mb-3">
                        <input type="text" name="username" id="username" class="form-control form-control-lg bg-light fs-6" placeholder="Username" autocomplete="off">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="email" name="email" id="email" class="form-control form-control-lg bg-light fs-6" placeholder="Email"  autocomplete="off">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="password" name="password" id="password" class="form-control form-control-lg bg-light fs-6" placeholder="Password" autocomplete="off">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="number" name="phone" id="phone" class="form-control form-control-lg bg-light fs-6" placeholder="Telepone"  autocomplete="off">
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="input-group mb-3">
                        <textarea class="form-control form-control-lg bg-light fs-6" name="address" cols="30" rows="2" placeholder="Alamat anda" id="address" autocomplete="off"></textarea>
                        <div class="invalid-feedback"></div>
                    </div>
                    <div class="input-group mb-3">
                        <input type="submit" value="Sign Up" class="btn btn-lg btn-primary w-100 fs-6" id="register-btn">
                    </div>
                    <div class="input-group mb-3">
                        <button class="btn btn-lg btn-light w-100 fs-6"><img src="{{asset('assets/img/google.png')}}" style="width:20px" class="me-2"><small>Sign Up with Google</small></button>
                    </div>
                    <div class="row">
                        <small>Already have account? <a href="/login">Sign In</a></small>
                    </div>
                </form> 
          </div>
       </div> 
      </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $("#register-form").submit(function(e) {
                e.preventDefault();
                $("#register-btn").val('Please Wait...');
                $.ajax({
                    url: '{{route('Auth.pages.register')}}',
                    method: 'post',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(res){
                        console.log(res);
                        if(res.status == 400){
                            showError('username', res.messages.username)
                            showError('email', res.messages.email)
                            showError('password', res.messages.password)
                            showError('phone', res.messages.phone)
                            showError('address', res.messages.address)
                            $("#register-btn").val('Register')
                        } else if(res.status == 200){
                            $(".show-success-alert").html(showMessage('success', res.messages));
                            $("#register-form")[0].reset()
                            removeValidationClasses("#register-form")
                            $("#register-btn").val('register')
                        }
                    }
                });
            });
        });
    </script>
@endsection