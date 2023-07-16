@extends('Layout/Base')
@section('content')
<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-header">
        <h4 class="mt-1" style="float: left"><b>Data Jenis Hewan</b></h4>
        <button onclick="clearInput()" class="btn btn-primary btn-rounded" style="float: right" id="createData">Tambah Data</button>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover" id="datatable">
            <thead>
              <tr>
                <th>Profile</th>
                <th>VatNo.</th>
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
              <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Jenis Hewan</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" id="nama_jenis" name="nama_jenis" placeholder="Input disini">
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
          $('#nama_jenis').val('')
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
            $.get(`${baseUrl}/api/v1/jenis/` + _id, function (res) {
                $('.modal-title' ).html  ("Formulir Edit Data" );
                $('#btn-simpan'  ).val   ("edit-user"          );
                $('#data-modal'  ).modal ('show'               );
                $('#nama_jenis'  ).val   (res.data.nama_jenis  );
                $('#id'          ).val   (res.data.id          );
            })
        });

        function postData() {
            const data = {
                id         : $('#id'         ).val(),
                nama_jenis : $('#nama_jenis' ).val(),
            }

            $.ajax({
                url        : `${baseUrl}/api/v1/jenis/`,
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
            $.get(`${baseUrl}/api/v1/jenis`, (res) => {
                let data = res.data

                $('#tbody').html('')
                $.each(data, (i,d) => {
                    $('#tbody').append(`
                        <tr>
                            <td>${i + 1}</td>
                            <td class="text-capitalize">${d.nama_jenis}</td>
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
                        url: `${baseUrl}/api/v1/jenis/${dataId}`,
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