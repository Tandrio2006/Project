@extends('layout.main')

@section('title', 'Daftar')

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
    }

    .wrapper {
        max-width: 700px;
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

    #saveCaptcha {
        background-color: #12876f;
        color: white;
        width: 100%;
    }
</style>
<div class="d-sm-flex align-items-center justify-content-center" style="height: 100vh; width:700px;">
    <div class="wrapper">
        <div class="title"><span>Daftar</span></div>
        <form action="/form/store" method="POST">
            @csrf
            <div class="mt-3">
                <label for="Username" class="form-label fw-bold">Username</label>
                <input type="text" class="form-control" id="Username" placeholder="Masukkan Username">
                <div id="UsernameError" class="text-danger mt-1 d-none">Silahkan isi Username</div>
            </div>
            <div class="mt-3">
                <label for="Email" class="form-label fw-bold">Email</label>
                <input type="email" class="form-control" id="Email" placeholder="Masukkan Email">
                <div id="EmailError" class="text-danger mt-1 d-none">Silahkan isi Email yang valid</div>
            </div>
            <div class="mt-3">
                <label for="Wa" class="form-label fw-bold">WhatsApp</label>
                <input type="text" class="form-control" id="Wa" placeholder="Masukkan No WhatsApp">
                <div id="WaError" class="text-danger mt-1 d-none">Silahkan isi No WhatsApp</div>
            </div>
            <div class="mt-3">
                <label for="Bank" class="form-label fw-bold">Bank</label>
                <input type="text" class="form-control" id="Bank" placeholder="Masukkan Nama Bank">
                <div id="BankError" class="text-danger mt-1 d-none">Silahkan isi Nama Bank</div>
            </div>
            <div class="mt-3">
                <label for="NamaRek" class="form-label fw-bold">Nama Rekening</label>
                <input type="text" class="form-control" id="NamaRek" placeholder="Masukkan Nama Rekening">
                <<div id="NamaRekError" class="text-danger mt-1 d-none">Silahkan isi Nama Rekening
            </div>
    </div>
    <div class="mt-3">
        <label for="NoRek" class="form-label fw-bold">No Rekening</label>
        <input type="text" class="form-control" id="NoRek" placeholder="Masukkan No Rekening">
        <div id="NoRekError" class="text-danger mt-1 d-none">Silahkan isi No Rekening</div>
    </div>
    <div class="mt-3">
        <div class="captcha">
            <span>{!! captcha_img('mini') !!}</span>
            <button type="button" class="btn btn-success reload" id="reload">
                &#x21bb;
            </button>
            <div class="form-group mb-3 mt-2">
                <input type="text" class="form-control" id="captcha" placeholder="Masukkan Captcha" name="captcha">
                <div id="CaptchaError" class="text-danger mt-1 d-none">Silahkan isi Captcha</div>
            </div>
        </div>
    </div>
    <div class="row button mb-2 mt-3">
        <button type="button" id="saveCaptcha" class="btn btn-success btn-block">Daftar</button>
    </div>
    </form>
</div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function () {
        var loadSpin = `<div class="d-flex justify-content-center align-items-center mt-5">
    <div class="spinner-border d-flex justify-content-center align-items-center text-primary" role="status"></div>
</div> `;

        $('#reload').click(function () {
            $.ajax({
                type: 'GET',
                url: '/api/reload-captcha',
                success: function (data) {
                    $(".captcha span").html(data.captcha);
                }
            });
        });

        $('#saveCaptcha').click(function () {
            var Username = $('#Username').val();
            var Email = $('#Email').val();
            var Wa = $('#Wa').val();
            var Bank = $('#Bank').val();
            var NamaRek = $('#NamaRek').val();
            var NoRek = $('#NoRek').val();
            var captcha = $('#captcha').val();
            var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var isValid = true;

            // Validation
            if (Username === '') {
                $('#UsernameError').removeClass('d-none');
                isValid = false;
            } else {
                $('#UsernameError').addClass('d-none');
            }

            if (Email === '') {
                $('#EmailError').text('Silahkan isi Email').removeClass('d-none');
                isValid = false;
            } else if (!emailRegex.test(Email)) {
                $('#EmailError').text('Format Email tidak valid').removeClass('d-none');
                isValid = false;
            } else if (!Email.endsWith('@gmail.com')) {
                $('#EmailError').text('Email harus menggunakan @gmail.com').removeClass('d-none');
                isValid = false;
            } else {
                $('#EmailError').addClass('d-none');
            }

            if (Wa === '') {
                $('#WaError').removeClass('d-none');
                isValid = false;
            } else {
                $('#WaError').addClass('d-none');
            }

            if (Bank === '') {
                $('#BankError').removeClass('d-none');
                isValid = false;
            } else {
                $('#BankError').addClass('d-none');
            }

            if (NamaRek === '') {
                $('#NamaRekError').removeClass('d-none');
                isValid = false;
            } else {
                $('#NamaRekError').addClass('d-none');
            }

            if (NoRek === '') {
                $('#NoRekError').removeClass('d-none');
                isValid = false;
            } else {
                $('#NoRekError').addClass('d-none');
            }

            if (captcha === '') {
                $('#CaptchaError').removeClass('d-none');
                isValid = false;
            } else {
                $('#CaptchaError').addClass('d-none');
            }

            if (isValid) {
                Swal.fire({
                    title: 'Apakah Anda yakin?',
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonColor: '#5D87FF',
                    cancelButtonColor: '#49BEFF',
                    confirmButtonText: 'Ya',
                    cancelButtonText: 'Tidak',
                    reverseButtons: true
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Loading...',
                            text: 'Please wait while we are updating the data.',
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                            }
                        });

                        $.ajax({
                            url: '/api/form/store',
                            method: 'POST',
                            data: {
                                Username: Username,
                                Email: Email,
                                Wa: Wa,
                                Bank: Bank,
                                NamaRek: NamaRek,
                                NoRek: NoRek,
                                captcha: captcha,
                                _token: '{{ csrf_token() }}',
                            },
                            success: function (response) {
                                Swal.close();
                                if (response.status) {
                                    showMessage("success", "berhasil ditambahkan").then(() => {
                                        location.reload();
                                    });
                                } else {
                                    Swal.fire("Error", response.message, "error");
                                }
                            },
                        });
                    }
                });
            }
        });
        $('#NoRek,#NoRekEdit,#Wa,#WaEdit').on('input', function () {
            this.value = this.value.replace(/[^0-9]/g, '');
        });
    });

</script>
@endsection