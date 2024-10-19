@extends('layout.app')

@section('title', 'Customer')

@section('app')

<style>
  .custom-btn {
    background-color: #1abc9c !important;
    border-color: #1abc9c !important;
}
.custom-outline-btn {
    color: #1abc9c; 
    border-color: #1abc9c; 
}

.custom-outline-btn:hover,
.custom-outline-btn:focus,
.custom-outline-btn:active {
    background-color: #1abc9c; 
    color: white; 
}
</style>

<div class="container-fluid" id="container-wrapper">

  <!-- Modal Tambah Admin -->
  <div class="modal fade" id="modalTambahAdmin" tabindex="-1" role="dialog" aria-labelledby="modalTambahAdminTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTambahAdminTitle">Tambah Admin</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="mt-3">
            <label for="name" class="form-label fw-bold">Username</label>
            <input type="text" class="form-control" id="name" placeholder="Masukkan Name">
            <div id="nameError" class="text-danger mt-1 d-none">Silahkan isi Username</div>
          </div>
          <div class="mt-3">
            <label for="email" class="form-label fw-bold">Email</label>
            <input type="email" class="form-control" id="email" placeholder="Masukkan Email">
            <div id="emailError" class="text-danger mt-1 d-none">Silahkan isi Email yang valid</div>
          </div>
          <div class="mt-3">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" placeholder="Masukkan password" required>
            <span id="passwordError" class="text-danger d-none">Password must be at least 8 characters long</span>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-outline-success" data-dismiss="modal">Close</button>
            <button type="button" id="saveAdmin" class="btn custom-btn text-white">Save changes</button>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Edit Admin -->
  <div class="modal fade" id="modalEditAdmin" tabindex="-1" role="dialog" aria-labelledby="modalEditAdminTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalEditAdminTitle">Edit Admin</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="mt-3">
            <label for="nameEdit" class="form-label fw-bold">Username</label>
            <input type="text" class="form-control" id="nameEdit" placeholder="Masukkan Name">
            <div id="nameErrorEdit" class="text-danger mt-1 d-none">Silahkan isi Username</div>
          </div>
          <div class="mt-3">
            <label for="emailEdit" class="form-label fw-bold">Email</label>
            <input type="email" class="form-control" id="emailEdit" placeholder="Masukkan Email">
            <div id="emailErrorEdit" class="text-danger mt-1 d-none">Silahkan isi Email yang valid</div>
          </div>
          <div class="mt-3">
            <label for="password">Password (New Password)</label>
            <input type="password" class="form-control" id="passwordEdit" placeholder="Masukkan password (new password) " required>
            <span id="passwordErrorEdit" class="text-danger d-none">Password must be at least 8 characters long</span>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-success custom-outline-btn" data-dismiss="modal">Close</button>
          <button type="button" id="saveEditAdmin" class="btn custom-btn text-white">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Tambah Customer -->
  <div class="modal fade" id="modalTambahCustomer" tabindex="-1" role="dialog"
    aria-labelledby="modalTambahCustomerTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTambahCustomerTitle">Tambah Customer</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
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
            <!-- <div id="BankError" class="text-danger mt-1 d-none">Silahkan isi Nama Bank</div> -->
          </div>
          <div class="mt-3">
            <label for="NamaRek" class="form-label fw-bold">Nama Rekening</label>
            <input type="text" class="form-control" id="NamaRek" placeholder="Masukkan Nama Rekening">
            <!-- <div id="NamaRekError" class="text-danger mt-1 d-none">Silahkan isi Nama Rekening</div> -->
          </div>
          <div class="mt-3">
            <label for="NoRek" class="form-label fw-bold">No Rekening</label>
            <input type="text" class="form-control" id="NoRek" placeholder="Masukkan No Rekening">
            <!-- <div id="NoRekError" class="text-danger mt-1 d-none">Silahkan isi No Rekening</div> -->
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-success custom-outline-btn" data-dismiss="modal">Close</button>
          <button type="button" id="saveCustomer" class="btn custom-btn text-white">Save changes</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Modal Edit Customer -->
  <div class="modal fade" id="modalEditCustomer" tabindex="-1" role="dialog" aria-labelledby="modalEditCustomerTitle"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalEditCustomerTitle">Edit Customer</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="mt-3">
            <label for="UsernameEdit" class="form-label fw-bold">Username</label>
            <input type="text" class="form-control" id="UsernameEdit" placeholder="Masukkan Username">
            <div id="UsernameErrorEdit" class="text-danger mt-1 d-none">Silahkan isi Username</div>
          </div>
          <div class="mt-3">
            <label for="EmailEdit" class="form-label fw-bold">Email</label>
            <input type="email" class="form-control" id="EmailEdit" placeholder="Masukkan Email">
            <div id="EmailErrorEdit" class="text-danger mt-1 d-none">Silahkan isi Email yang valid</div>
          </div>
          <div class="mt-3">
            <label for="WaEdit" class="form-label fw-bold">WhatsApp</label>
            <input type="text" class="form-control" id="WaEdit" placeholder="Masukkan No WhatsApp">
            <div id="WaErrorEdit" class="text-danger mt-1 d-none">Silahkan isi No WhatsApp</div>
          </div>
          <div class="mt-3">
            <label for="BankEdit" class="form-label fw-bold">Bank</label>
            <input type="text" class="form-control" id="BankEdit" placeholder="Masukkan Nama Bank">
            <!-- <div id="BankErrorEdit" class="text-danger mt-1 d-none">Silahkan isi Nama Bank</div> -->
          </div>
          <div class="mt-3">
            <label for="NamaRekEdit" class="form-label fw-bold">Nama Rekening</label>
            <input type="text" class="form-control" id="NamaRekEdit" placeholder="Masukkan Nama Rekening">
            <!-- <div id="NamaRekErrorEdit" class="text-danger mt-1 d-none">Silahkan isi Nama Rekening</div> -->
          </div>
          <div class="mt-3">
            <label for="NoRekEdit" class="form-label fw-bold">No Rekening</label>
            <input type="text" class="form-control" id="NoRekEdit" placeholder="Masukkan No Rekening">
            <!-- <div id="NoRekErrorEdit" class="text-danger mt-1 d-none">Silahkan isi No Rekening</div> -->
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-outline-success custom-outline-btn" data-dismiss="modal">Close</button>
          <button type="button" id="saveEditCustomer" class="btn custom-btn text-white">Save changes</button>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="container mt-5">
  <div class="profile d-flex align-items-center mb-4">
    <img src="/img/Profile.jpg" alt="Profile Picture"
      style="border-radius: 50%; width: 50px; height: 50px; margin-right: 10px;">
    <h5 style="margin: 0; color: #343a40;">Admin </h5>
  </div>
  <div class="profile d-flex align-items-center mb-4">
    <form action="{{route('logout')}}" method="POST">
      @csrf
      <button type="submit" class="btn btn-outline-secondary">logout</button>
    </form>
  </div>
  <ul class="nav nav-tabs">
    <li class="nav-item">
      <a class="nav-links nav-link active" aria-current="page" href="#" data-tab="roleTab" style="color:#1abc9c">Customer</a>
    </li>
    <li class="nav-item">
      <a class="nav-links nav-link " href="#" data-tab="AksesTab" style="color:#1abc9c">Admin</a>
    </li>
  </ul>
  <div class="tab-content mt-3">
    <div id="roleTab" class="tab-pane fade show active">
      <div class="row mb-3">
        <div class="col-xl-12">
          <div class="card shadow" style="border: none; border-radius: 10px;">
            <div class="card-body">
              <div class="d-flex mb-2 mr-3 float-right">
                <button type="button" class="btn custom-btn text-white" data-toggle="modal"
                  data-target="#modalTambahCustomer"><span class="pr-2"><i class="fas fa-plus"></i></span>Tambah
                  Customer</button>
              </div>

              <div class="d-flex mb-2 mr-3 float-left">
                <button type="button" class="btn custom-btn text-white" id="exportBtn"><span class="pr-2"><i
                      class="fa-regular fa-file-excel"></i></span>Export</button>
              </div>
              <div id="containerCustomer" class="table-responsive">
                <table class="table align-items-center table-flush table-hover " id="tableCustomer">
                  <thead class="thead-light">
                    <tr>
                      <th>Username</th>
                      <th>Email</th>
                      <th>Wa</th>
                      <th>Bank</th>
                      <th>Nama rek</th>
                      <th>No rek</th>
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- <tr>
                  <td>1.</td>
                  <td>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Distinctio natus aspernatur eligendi, aperiam voluptatibus quia! Facere eveniet consequuntur nostrum molestias, asperiores cupiditate quibusdam dolore molestiae quod modi? Assumenda, tenetur repudiandae?</td>
                  <td><img src="/img/Aboutus.jpg" width="50px"></td>
                  <td>
                    <a href="#" class="btn btn-sm btn-secondary"><i class="fas fa-edit"></i></a>
                    <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                    <a href="#" class="btn btn-sm btn-primary btnGambar"><i class="fas fa-eye"></i></a>
                  </td>
                </tr> -->
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="AksesTab" class="tab-pane fade">
      <div class="row mb-3">
        <div class="col-xl-12">
          <div class="card shadow" style="border: none; border-radius: 10px;">
            <div class="card-body">
              <div class="d-flex mb-2 mr-3 float-right">
                <button type="button" class="btn custom-btn text-white" data-toggle="modal" data-target="#modalTambahAdmin"><span
                    class="pr-2"><i class="fas fa-plus" ></i></span>Tambah
                  Admin</button>
              </div>
              <div class="d-flex mb-2 mr-3 float-left">
                <button type="button" class="btn custom-btn text-white" id="exportBtnAdmin"><span class="pr-2"><i
                      class="fa-regular fa-file-excel"></i></span>Export</button>
              </div>
              <div id="containerAdmin" class="table-responsive">
                <table class="table align-items-center table-flush table-hover " id="tableAdmin">
                  <thead class="thead-light">
                    <tr>
                      <th>Nama</th>
                      <th>Email</th>
                      <!-- <th>Password</th> -->
                      <th>Action</th>
                    </tr>
                  </thead>
                  <tbody>
                    <!-- <tr>
                  <td>1.</td>
                  <td>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Distinctio natus aspernatur eligendi, aperiam voluptatibus quia! Facere eveniet consequuntur nostrum molestias, asperiores cupiditate quibusdam dolore molestiae quod modi? Assumenda, tenetur repudiandae?</td>
                  <td><img src="/img/Aboutus.jpg" width="50px"></td>
                  <td>
                    <a href="#" class="btn btn-sm btn-secondary"><i class="fas fa-edit"></i></a>
                    <a href="#" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a>
                    <a href="#" class="btn btn-sm btn-primary btnGambar"><i class="fas fa-eye"></i></a>
                  </td>
                </tr> -->
                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
@endsection
@section('script')
<script>
  $(document).ready(function () {
    var loadSpin = `<div class="d-flex justify-content-center align-items-center mt-5">
    <div class="spinner-border d-flex justify-content-center align-items-center text-success" role="status"></div>
</div> `;

    var table = $('#tableCustomer').DataTable({
      serverSide: true,
      ajax: {
        url: "{{ route('customer.data') }}",
        method: 'GET',
      },
      columns: [
        {
          data: 'Username',
          name: 'Username',
        },
        {
          data: 'Email',
          name: 'Email',
        },
        {
          data: 'Wa',
          name: 'Wa',
        },
        {
          data: 'Bank',
          name: 'Bank',
          render: function (data, type, row) {
            return data ? data : '-';
          }
        },
        {
          data: 'NamaRek',
          name: 'NamaRek',
          render: function (data, type, row) {
            return data ? data : '-';
          }
        },
        {
          data: 'NoRek',
          name: 'NoRek',
          render: function (data, type, row) {
            return data ? data : '-';
          }
        },
        {
          data: 'action',
          name: 'action',
          orderable: false,
          searchable: false,
        }
      ],
      lengthChange: false,
      language: {
        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
        infoEmpty: "Showing 0 to 0 of 0 entries",
        emptyTable: "No data available in table",
        loadingRecords: "Loading...",
        zeroRecords: "No matching records found"
      }
    });


    $('#saveCustomer').click(function () {
      var Username = $('#Username').val();
      var Email = $('#Email').val();
      var Wa = $('#Wa').val();
      var Bank = $('#Bank').val();
      var NamaRek = $('#NamaRek').val();
      var NoRek = $('#NoRek').val();
      var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

      var csrfToken = $('meta[name="csrf-token"]').attr('content');

      var isValid = true;

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

      // if (Bank === '') {
      //   $('#BankError').removeClass('d-none');
      //   isValid = false;
      // } else {
      //   $('#BankError').addClass('d-none');
      // }

      // if (NamaRek === '') {
      //   $('#NamaRekError').removeClass('d-none');
      //   isValid = false;
      // } else {
      //   $('#NamaRekError').addClass('d-none');
      // }

      // if (NoRek === '') {
      //   $('#NoRekError').removeClass('d-none');
      //   isValid = false;
      // } else {
      //   $('#NoRekError').addClass('d-none');
      // }
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
              url: '/customer/store',
              method: 'POST',
              data: {
                Username: Username,
                Email: Email,
                Wa: Wa,
                Bank: Bank,
                NamaRek: NamaRek,
                NoRek: NoRek,
                _token: '{{ csrf_token() }}',
              },
              success: function (response) {
                Swal.close();
                if (response.success) {
                  table.ajax.reload();
                  $('.modal-backdrop').remove();
                  showMessage("success",
                    "berhasil ditambahkan");
                  $('#modalTambahCustomer').modal('hide');

                }
              },
              error: function (response) {
                Swal.close();
                Swal.fire("Error", "Terjadi kesalahan, coba lagi nanti", "error");
              }
            });
          }
        });
      }
    });

    $(document).on('click', '.btnUpdateCustomer', function () {
      var customerid = $(this).data('id');
      $.ajax({
        url: '/customer/' + customerid,
        method: 'GET',
        success: function (response) {
          $('#UsernameEdit').val(response.Username);
          $('#EmailEdit').val(response.Email);
          $('#WaEdit').val(response.Wa);
          $('#BankEdit').val(response.Bank);
          $('#NamaRekEdit').val(response.NamaRek);
          $('#NoRekEdit').val(response.NoRek);
          $('#saveEditCustomer').data('id', customerid);
          $('#modalEditCustomer').modal('show');
        },
        error: function () {
          Swal.fire("Error", "Terjadi Kesalahan pada Email atau Coba lagi nanti", "error");
        }
      });
    });

    $('#saveEditCustomer').click(function () {
      var customerid = $(this).data('id');
      var Username = $('#UsernameEdit').val().trim();
      var Email = $('#EmailEdit').val().trim();
      var Wa = $('#WaEdit').val().trim();
      var Bank = $('#BankEdit').val().trim();
      var NamaRek = $('#NamaRekEdit').val().trim();
      var NoRek = $('#NoRekEdit').val().trim();
      var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

      var isValid = true;

      if (Username === '') {
        $('#UsernameErrorEdit').removeClass('d-none');
        isValid = false;
      } else {
        $('#UsernameErrorEdit').addClass('d-none');
      }
      if (Email === '') {
        $('#EmailErrorEdit').text('Silahkan isi Email').removeClass('d-none');
        isValid = false;
      } else if (!emailRegex.test(Email)) {
        $('#EmailErrorEdit').text('Format Email tidak valid').removeClass('d-none');
        isValid = false;
      } else if (!Email.endsWith('@gmail.com')) {
        $('#EmailErrorEdit').text('Email harus menggunakan @gmail.com').removeClass('d-none');
        isValid = false;
      } else {
        $('#EmailErrorEdit').addClass('d-none');
      }
      if (Wa === '') {
        $('#WaErrorEdit').removeClass('d-none');
        isValid = false;
      } else {
        $('#WaErrorEdit').addClass('d-none');
      }

      // if (Bank === '') {
      //   $('#BankErrorEdit').removeClass('d-none');
      //   isValid = false;
      // } else {
      //   $('#BankErrorEdit').addClass('d-none');
      // }

      // if (NamaRek === '') {
      //   $('#NamaRekErrorEdit').removeClass('d-none');
      //   isValid = false;
      // } else {
      //   $('#NamaRekErrorEdit').addClass('d-none');
      // }

      // if (NoRek === '') {
      //   $('#NoRekErrorEdit').removeClass('d-none');
      //   isValid = false;
      // } else {
      //   $('#NoRekErrorEdit').addClass('d-none');
      // }

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
              url: '/customer/updateCustomer/' + customerid,
              method: 'PUT',
              data: {
                Username: Username,
                Email: Email,
                Wa: Wa,
                Bank: Bank,
                NamaRek: NamaRek,
                NoRek: NoRek,
                _token: '{{ csrf_token() }}',
              },
              success: function (response) {
                Swal.close();
                if (response.success) {
                  Swal.fire("Success", response.message, "success");
                  $('#modalEditCustomer').modal('hide');
                  table.ajax.reload();
                }
              },
              error: function (response) {
                Swal.close();
                Swal.fire("Error", "Terjadi Kesalahan pada Email atau Coba lagi nanti", "error");
              }
            });
          }
        });
      }
    });
    $('#NoRek,#NoRekEdit,#Wa,#WaEdit').on('input', function () {
      this.value = this.value.replace(/[^0-9]/g, '');
    });
    $('#modalTambahCustomer').on('hidden.bs.modal', function () {
      $('#Username,#Email,#Wa,#Bank,#NamaRek,#NoRek').val('');
      if (!$('#UsernameError').hasClass('d-none')) {
        $('#UsernameError').addClass('d-none');

      }
      if (!$('#EmailError').hasClass('d-none')) {
        $('#EmailError').addClass('d-none');

      }
      if (!$('#WaError').hasClass('d-none')) {
        $('#WaError').addClass('d-none');

      }
      if (!$('#BankError').hasClass('d-none')) {
        $('#BankError').addClass('d-none');

      }
      if (!$('#NamaRekError').hasClass('d-none')) {
        $('#NamaRekError').addClass('d-none');

      }
      if (!$('#NoRekError').hasClass('d-none')) {
        $('#NoRekError').addClass('d-none');

      }
    });
    $('#modalEditCustomer').on('hidden.bs.modal', function () {
      $('#UsernameEdit,#EmailEdit,#WaEdit,#BankEdit,#NamaRekEdit,#NoRekEdit').val('');
      if (!$('#UsernameErrorEdit').hasClass('d-none')) {
        $('#UsernameErrorEdit').addClass('d-none');

      }
      if (!$('#EmailErrorEdit').hasClass('d-none')) {
        $('#EmailErrorEdit').addClass('d-none');

      }
      if (!$('#WaErrorEdit').hasClass('d-none')) {
        $('#WaErrorEdit').addClass('d-none');

      }
      if (!$('#BankErrorEdit').hasClass('d-none')) {
        $('#BankErrorEdit').addClass('d-none');

      }
      if (!$('#NamaRekErrorEdit').hasClass('d-none')) {
        $('#NamaRekErrorEdit').addClass('d-none');

      }
      if (!$('#NoRekErrorEdit').hasClass('d-none')) {
        $('#NoRekErrorEdit').addClass('d-none');

      }
    });
    $(document).on('click', '.btnDestroyCustomer', function (e) {
      let id = $(this).data('id');

      Swal.fire({
        title: "Apakah Kamu Yakin Ingin Hapus Ini?",
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
            text: 'Please wait while we process your request.',
            allowOutsideClick: false,
            didOpen: () => {
              Swal.showLoading();
            }
          });

          $.ajax({
            url: '/customer/deleteCustomer/' + id,
            method: 'DELETE',
            data: {
              id: id,
              _token: $('meta[name="csrf-token"]').attr('content'),
            },
            success: function (response) {
              Swal.close();
              if (response.status === 'success') {
                Swal.fire("Success", response.message, "success");
                table.ajax.reload();
              } else {
                Swal.fire("Error", response.message, "error");
              }
            },
            error: function () {
              Swal.close();
              Swal.fire("Error", "Terjadi kesalahan, coba lagi nanti", "error");
            }
          });
        }
      });
    });
    $('#exportBtn').on('click', function () {
      $.ajax({
        url: "{{route('ExportCustomer')}}",
        type: 'GET',
        xhrFields: {
          responseType: 'blob'
        },
        success: function (data) {
          var blob = new Blob([data], {
            type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
          });
          var link = document.createElement('a');
          link.href = window.URL.createObjectURL(blob);
          link.download = "customers.xlsx";
          link.click();
        },
        error: function () {
          Swal.fire({
            title: "Export failed!",
            icon: "error"
          });
        }
      });
    });
  });
  $(document).ready(function () {
    var loadSpin = `<div class="d-flex justify-content-center align-items-center mt-5">
    <div class="spinner-border d-flex justify-content-center align-items-center text-success" role="status"></div>
</div> `;
    var table = $('#tableAdmin').DataTable({
      serverSide: true,
      ajax: {
        url: "{{route('admin.data')}}",
        method: 'GET',
      },
      columns: [
        {
          data: 'name',
          name: 'name',
        },
        {
          data: 'email',
          name: 'email',
        },
        {
          data: 'action',
          name: 'action',
          orderable: false,
          searchable: false,
        }
      ],
      lengthChange: false,
      language: {
        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
        infoEmpty: "Showing 0 to 0 of 0 entries",
        emptyTable: "No data available in table",
        loadingRecords: "Loading...",
        zeroRecords: "No matching records found"
      }
    });


    $('#saveAdmin').click(function () {
      var name = $('#name').val();
      var email = $('#email').val();
      var password = $('#password').val();
      var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

      var csrfToken = $('meta[name="csrf-token"]').attr('content');

      var isValid = true;

      if (name === '') {
        $('#nameError').removeClass('d-none');
        isValid = false;
      } else {
        $('#nameError').addClass('d-none');
      }
      if (email === '') {
        $('#emailError').text('Silahkan isi Email').removeClass('d-none');
        isValid = false;
      } else if (!emailRegex.test(email)) {
        $('#emailError').text('Format Email tidak valid').removeClass('d-none');
        isValid = false;
      } else if (!email.endsWith('@gmail.com')) {
        $('#emailError').text('Email harus menggunakan @gmail.com').removeClass('d-none');
        isValid = false;
      } else {
        $('#emailError').addClass('d-none');
      }

      if (password.length < 8) {
        $('#passwordError').removeClass('d-none');
        isValid = false;
      } else {
        $('#passwordError').addClass('d-none');
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
              url: '/admin/store',
              method: 'POST',
              data: {
                name: name,
                email: email,
                password: password,
                _token: '{{ csrf_token() }}',
              },
              success: function (response) {
                Swal.close();
                if (response.success) {
                  $('.modal-backdrop').remove();
                  showMessage("success",
                    "berhasil ditambahkan");
                  $('#modalTambahAdmin').modal('hide');
                  table.ajax.reload();
                }
              },
              error: function (response) {
                Swal.close();
                Swal.fire("Error", "Terjadi kesalahan, coba lagi nanti", "error");
              }
            });
          }
        });
      }
    });

    $(document).on('click', '.btnUpdateAdmin', function () {
      var Adminid = $(this).data('id');
      $.ajax({
        url: '/admin/' + Adminid,
        method: 'GET',
        success: function (response) {
          $('#nameEdit').val(response.name);
          $('#emailEdit').val(response.email);
          $('#saveEditAdmin').data('id', Adminid);
          $('#modalEditAdmin').modal('show');
        },
        error: function () {
          Swal.fire("Error", "Terjadi Kesalahan pada Email atau Coba lagi nanti", "error");
        }
      });
    });

    $('#saveEditAdmin').click(function () {
      var Adminid = $(this).data('id');
      var name = $('#nameEdit').val().trim();
      var email = $('#emailEdit').val().trim();
      var password = $('#passwordEdit').val().trim();
      var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

      var isValid = true;

      if (name === '') {
        $('#nameErrorEdit').removeClass('d-none');
        isValid = false;
      } else {
        $('#nameErrorEdit').addClass('d-none');
      }
      if (email === '') {
        $('#emailErrorEdit').text('Silahkan isi Email').removeClass('d-none');
        isValid = false;
      } else if (!emailRegex.test(email)) {
        $('#emailErrorEdit').text('Format Email tidak valid').removeClass('d-none');
        isValid = false;
      } else if (!email.endsWith('@gmail.com')) {
        $('#emailErrorEdit').text('Email harus menggunakan @gmail.com').removeClass('d-none');
        isValid = false;
      } else {
        $('#emailErrorEdit').addClass('d-none');
      }
      if (password.length < 8) {
        $('#passwordErrorEdit').removeClass('d-none');
        isValid = false;
      } else {
        $('#passwordErrorEdit').addClass('d-none');
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
              url: '/admin/updateAdmin/' + Adminid,
              method: 'PUT',
              data: {
                name: name,
                email: email,
                password: password,
                _token: '{{ csrf_token() }}',
              },
              success: function (response) {
                Swal.close();
                if (response.success) {
                  Swal.fire("Success", response.message, "success");
                  $('#modalEditAdmin').modal('hide');
                  table.ajax.reload();
                }
              },
              error: function (response) {
                Swal.close();
                Swal.fire("Error", "Terjadi Kesalahan pada Email atau Coba lagi nanti", "error");
              }
            });
          }
        });
      }
    });
    $('#NoRek,#NoRekEdit,#Wa,#WaEdit').on('input', function () {
      this.value = this.value.replace(/[^0-9]/g, '');
    });
    $('#modalTambahAdmin').on('hidden.bs.modal', function () {
      $('#name,#email,#password').val('');
      if (!$('#nameError').hasClass('d-none')) {
        $('#nameError').addClass('d-none');

      }
      if (!$('#emailError').hasClass('d-none')) {
        $('#emailError').addClass('d-none');

      }
      if (!$('#passwordError').hasClass('d-none')) {
        $('#passwordError').addClass('d-none');

      }
    });
    $('#modalEditAdmin').on('hidden.bs.modal', function () {
      $('#nameEdit,#emailEdit,#passwordEdit').val('');
      if (!$('#nameErrorEdit').hasClass('d-none')) {
        $('#nameErrorEdit').addClass('d-none');

      }
      if (!$('#emailErrorEdit').hasClass('d-none')) {
        $('#emailErrorEdit').addClass('d-none');

      }
      if (!$('#passwordErrorEdit').hasClass('d-none')) {
        $('#passwordErrorEdit').addClass('d-none');

      }
    });
    $(document).on('click', '.btnDestroyAdmin', function (e) {
      let id = $(this).data('id');

      Swal.fire({
        title: "Apakah Kamu Yakin Ingin Hapus Ini?",
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
            text: 'Please wait while we process your request.',
            allowOutsideClick: false,
            didOpen: () => {
              Swal.showLoading();
            }
          });

          $.ajax({
            url: '/admin/deleteAdmin/' + id,
            method: 'DELETE',
            data: {
              id: id,
              _token: $('meta[name="csrf-token"]').attr('content'),
            },
            success: function (response) {
              Swal.close();
              if (response.status === 'success') {
                Swal.fire("Success", response.message, "success");
                table.ajax.reload();
              } else {
                Swal.fire("Error", response.message, "error");
              }
            },
            error: function () {
              Swal.close();
              Swal.fire("Error", "Terjadi kesalahan, coba lagi nanti", "error");
            }
          });
        }
      });
    });
    $('.nav-links').on('click', function (e) {
      e.preventDefault();
      var tab = $(this).data('tab');

      $('.tab-pane').removeClass('show active');
      $('#' + tab).addClass('show active');

      $('.nav-links').removeClass('active');
      $(this).addClass('active');
    });
    $('#exportBtnAdmin').on('click', function () {
      $.ajax({
        url: "{{route('ExportAdmin')}}",
        type: 'GET',
        xhrFields: {
          responseType: 'blob'
        },
        success: function (data) {
          var blob = new Blob([data], {
            type: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet"
          });
          var link = document.createElement('a');
          link.href = window.URL.createObjectURL(blob);
          link.download = "Admin.xlsx";
          link.click();
        },
        error: function () {
          Swal.fire({
            title: "Export failed!",
            icon: "error"
          });
        }
      });
    });
  });
</script>
@endsection