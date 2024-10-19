@extends('layout.main')

@section('title', 'Login')

@section('main')
<style>

* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
  font-family: "Poppins", sans-serif;
}

body {
  display: flex;
  align-items: center;
  justify-content: center;
  height: 100vh;
  background: #1abc9c;
  overflow: hidden;
}

.wrapper {
  max-width: 500px;
  width: 100%;
  background: #fff;
  border-radius: 5px;
  box-shadow: 0px 4px 10px 1px rgba(0, 0, 0, 0.1);
}

.wrapper .title {
  height: 120px;
  background: #16a085;
  border-radius: 5px 5px 0 0;
  color: #fff;
  font-size: 30px;
  font-weight: 600;
  display: flex;
  align-items: center;
  justify-content: center;
}

.wrapper form {
  padding: 25px 35px;
}

.wrapper form .row {
  height: 60px;
  margin-top: 15px;
  position: relative;
}

.wrapper form .row input {
  height: 100%;
  width: 100%;
  outline: none;
  padding-left: 70px;
  border-radius: 5px;
  border: 1px solid lightgrey;
  font-size: 18px;
  transition: all 0.3s ease;
}

form .row input:focus {
  border-color: #16a085;
}

form .row input::placeholder {
  color: #999;
}

.wrapper form .row i {
  position: absolute;
  width: 55px;
  height: 100%;
  color: #fff;
  font-size: 22px;
  background: #16a085;
  border: 1px solid #16a085;
  border-radius: 5px 0 0 5px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.wrapper form .pass {
  margin-top: 12px;
}

.wrapper form .pass a {
  color: #16a085;
  font-size: 17px;
  text-decoration: none;
}

.wrapper form .pass a:hover {
  text-decoration: underline;
}

.wrapper form .button input {
  margin-top: 20px;
  color: #fff;
  font-size: 20px;
  font-weight: 500;
  padding-left: 0px;
  background: #16a085;
  border: 1px solid #16a085;
  cursor: pointer;
}

form .button input:hover {
  background: #12876f;
}

</style>
<div class="d-sm-flex align-items-center justify-content-center" style="height: 100vh; width:500px;">
  <div class="wrapper">
    <div class="title"><span>Login</span></div>
    <form id="loginForm" class="user" method="POST">
      @csrf
      <div class="row">
        <i class="fas fa-user"></i>
        <input type="email" name="email" placeholder="Email" id="email" required /> 
      </div>
      <div class="row">
        <i class="fas fa-lock"></i>
        <input type="password" name="password" placeholder="Password" id="password" required />
      </div>
      <div class="row button mb-4">
        <input type="submit" value="Login" />
      </div>
    </form>
  </div>
</div>
@endsection
@section('script')
<script>
   $(document).ready(function() {
            $('#loginForm').on('submit', function(event) {
                event.preventDefault();

                Swal.fire({
                    title: 'Checking...',
                    html: 'Please wait while we check your credentials.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                    }
                });

                $.ajax({
                    url: '/login',
                    method: 'POST',
                    data: $(this).serialize(),
                    success: function(response) {
                        Swal.close();

                        if (response.success) {
                            Swal.fire({
                                icon: 'success',
                                title: 'Berhasil!',
                                text: response.message,
                                showConfirmButton: false,
                                timer: 2000
                            }).then(() => {
                                window.location.href = response.redirect;
                            });
                        } else {
                            showMessage("error", response
                                .message);
                        }
                    },
                    error: function(xhr) {
                        Swal.close(); 

                        Swal.fire({
                            icon: 'error',
                            title: 'Error!',
                            text: 'Terjadi kesalahan pada server. Silakan coba lagi.',
                            showConfirmButton: true
                        });
                    }
                });
            });
        });

</script>
@endsection
