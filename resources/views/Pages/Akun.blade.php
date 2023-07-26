@extends('Layout/Base')
@section('title')
    Akun
@endsection
@section('content')
<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-header">
        <h4 class="mt-1" style="float: left"><b>Data Akun</b></h4>
        <button onclick="clearInput()" class="btn btn-primary btn-rounded" style="float: right" id="createData">Tambah Data</button>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover" id="datatable">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>Username</th>
                <th>Created at</th>
                <th>Updated at</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody id="tbody">
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>
  
  <!-- Modal -->
  <div class="modal fade" id="data-modal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        </div>
        <div class="modal-body">
            <input type="hidden" id="id" name="id">
            <div class="form-group row">
              <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Nama</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="nama" name="nama" placeholder="Input disini">
                <span class="text-danger text-small" id="alert-jenis"></span>
              </div>
              <label for="exampleInputUsername2" class="col-sm-3 col-form-label mt-3">Username</label>
              <div class="col-sm-9">
                <input type="text" class="form-control mt-3" id="username" name="username" placeholder="Input disini">
                <span class="text-danger text-small" id="alert-jenis"></span>
              </div>
              <label for="exampleInputUsername2" class="col-sm-3 col-form-label mt-3">Password</label>
              <div class="col-sm-9">
                <input type="password" class="form-control mt-3" id="password" name="password" placeholder="Input disini">
                <span class="text-danger text-small" id="alert-jenis"></span>
              </div>
              <label for="exampleInputUsername2" class="col-sm-3 col-form-label mt-3">Profile</label>
              <div class="col-sm-9">
                <select name="profile_id" id="profile_id" class="form-control mt-3">
                  <option value="" selected disabled>-- Pilih --</option>
                  @foreach ($profil as $d)
                      <option value="{{$d->id}}">{{$d->nama_pemilik}}</option>
                  @endforeach
                </select>
                <span class="text-danger text-small" id="alert-jenis"></span>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" onclick="closeModal()">Close</button>
          <button id="btn-simpan" onclick="postData()" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('script')
    <script>
        let baseUrl

        $(document).ready(function() {
            baseUrl = "{{ config('app.url') }}"

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });
        
        function closeModal() {
          $('#data-modal').modal('hide')
        }

        function clearInput(){
          $('#nama').val('')
          $('#username').val('')
          $('#profile_id').val('')
        }

        $('#createData').click(function () {
            $('.modal-title').html   ("Formulir Tambah Data");
            $('#btn-simpan' ).val    ("create-Item"         );
            $('#id'         ).val    (''                    );
            $('#formData'   ).trigger("reset"               );
            $('#data-modal' ).modal  ('show'                );
        });

        $('body').on('click', '#btn-edit', function () {
            var _id = $(this).data('id');
            $.get(`${baseUrl}/api/v1/akun/` + _id, function (res) {
                $('.modal-title' ).html  ("Formulir Edit Data"                            );
                $('#btn-simpan'  ).val   ("edit-user"                                     );
                $('#data-modal'  ).modal ('show'                                          );
                $('#nama'        ).val   (res.data.nama                                   );
                $('#username'    ).val   (res.data.username                               );
                $('#password'    ).val   (res.data.password                               );
                $('#profile_id'  ).val   (res.data.profile_id                             );
                $('#password'    ).attr  ('placeholder', 'Silahkan masukan password baru' );
                $('#id'          ).val   (res.data.id                                     );
            })
        });

        function postData() {
            const data = {
                id         : $('#id'         ).val(),
                nama       : $('#nama'       ).val(),
                username   : $('#username'   ).val(),
                password   : $('#password'   ).val(),
                profile_id : $('#profile_id' ).val(),
            }

            $.ajax({
                url        : `${baseUrl}/api/v1/akun`,
                method     : "POST"                   ,
                data       : data                     ,
                success: function(res) {
                  Swal.fire({
                    title            : 'Success'               ,
                    text             : 'Data berhasil ditambahkan',
                    icon             : 'success'               ,
                    cancelButtonColor: '#d33'                  ,
                    confirmButtonText: 'Oke'
                  })
                  $('#data-modal').modal('hide')  
                  getAllData()
                },
                error: function(err) {
                    if (err.status = 422) {
                        let data = err.responseJSON
                        let errorRes = data.errors;
                        if (errorRes.length >= 1) {
                            $.each(errorRes.data, (i, d) => {
                                $(`#alert${i}`).html(d)
                            })
                        }
                    } else {
                        iziToast.error({
                            title   : 'Error'                    ,
                            message : 'Server sedang maintenance',
                            position: 'topRight'
                        });
                    }
                },
                dataType   : "json"
            });
        }

        function getAllData() {
            $('#datatable').DataTable().destroy()
            $.get(`${baseUrl}/api/v1/akun`, (res) => {
                let data = res.data

                $('#tbody').html('')
                $.each(data, (i,d) => {
                    $('#tbody').append(`
                        <tr>
                            <td>${i + 1}</td>
                            <td class="text-capitalize">${d.nama}</td>
                            <td class="text-capitalize">${d.username}</td>
                            <td>${moment(d.created_at).locale('id').format('DD, MMMM YYYY')}</td>
                            <td>${moment(d.updated_at).locale('id').format('DD, MMMM YYYY')}</td>
                            <td>
                            <button id="btn-edit" data-id="${d.id}" class="btn rounded btn-sm btn-outline-primary mr-1">Edit</button>
                            <button id="btn-hapus" data-id="${d.id}" class="btn rounded btn-sm btn-outline-danger">Hapus</button>
                            </td>
                        </tr>
                    `)
                })

                $('#datatable').DataTable();
            })
            .fail((err) => {
                iziToast.error({
                    title   : 'Error'                    ,
                    message : 'Server sedang maintenance',
                    position: 'topRight'
                });
            })
        }

        $(document).on('click', '#btn-hapus', function() {
            let dataId = $(this).data('id')
            Swal.fire({
                title: 'Apakah anda yakin?',
                text: "Data tidak dapat dipulihkan!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, hapus!'
            }).then((result) => {
                if (result.isConfirmed) {
                    Swal.fire({
                        title: 'Waiting',
                        text: "Processing Data!",
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading()
                        }
                    })
                    $.ajax({
                        url: `${baseUrl}/api/v1/akun/${dataId}`,
                        type: 'delete',
                        success: function(result) {
                            let data = result.data;
                            setTimeout(() => {
                                Swal.close()
                                getAllData()
                                Swal.fire({
                                  title            : 'Success'               ,
                                  text             : 'Data berhasil dihapus',
                                  icon             : 'success'               ,
                                  cancelButtonColor: '#d33'                  ,
                                  confirmButtonText: 'Oke'
                                })
                            }, 500);
                        },
                        error: function(result) {
                            let data = result.responseJSON
                            Swal.fire({
                                icon     : 'error' ,
                                title    : 'Error' ,
                                text     : data.response.message,
                                position : 'topRight'
                            });
                        }
                    });
                }
            })
        })
        $(document).ready(function() 
        {
            getAllData()
        })
    </script>
@endsection