@extends('Layout/Base')
@section('content')
<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-header">
        <h4 class="mt-1" style="float: left"><b>Data Profile</b></h4>
        <button class="btn btn-primary btn-rounded" style="float: right" id="createData">Tambah Data</button>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover" id="tabledata">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Pemilik.</th>
                <th>Nama Usaha</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Foto</th>
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
            <form action="" id="formData">
              <input type="hidden" id="id" name="id">
              <div class="form-group row">
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Nama pemilik</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control mb-3" id="nama_pemilik" name="nama_pemilik" placeholder="Input disini">
                  <span class="text-danger text-small" id="alert-nama_pemilik"></span>
                </div>
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Nama Usaha</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control mb-3" id="nama_usaha" name="nama_usaha" placeholder="Input disini">
                  <span class="text-danger text-small" id="alert-nama_usaha"></span>
                </div>
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Alamat</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control mb-3" id="alamat" name="alamat" placeholder="Input disini">
                  <span class="text-danger text-small" id="alert-alamat"></span>
                </div>
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Telepon</label>
                <div class="col-sm-9">
                  <input type="text" class="form-control mb-3" id="telepon" name="telepon" placeholder="Input disini">
                  <span class="text-danger text-small" id="alert-telepon"></span>
                </div>
                <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Foto</label>
                <div class="col-sm-9">
                  <input type="file" class="form-control" id="foto" name="foto" placeholder="Input disini">
                  <span class="text-danger text-small" id="alert-alamat"></span>
                </div>
              </div>
            </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary text-light" onclick="closeModal()">Close</button>
          <button id="btn-simpan" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('script')
    <script>
        const baseUrl = `{{ config('app.url') }}`

        function clearInput() {
            $('#id'             ).val  ('')
            $('#nama_pemilik'   ).val  ('')
            $('#alert_jabatan'  ).html ('')
            $('#nama_usaha'     ).val  ('')
            $('#alertdeskripsi' ).html ('')
            $('#alamat'         ).val  ('')
            $('#telepon'        ).val  ('')
        }

        function closeModal() {
          $('#data-modal').modal('hide')
        }

        $('#createData').click(function () {
            $('.modal-title').html   ("Formulir Tambah Data");
            $('#btn-simpan' ).val    ("create-Item"         );
            $('#id'         ).val    (''                    );
            clearInput()
            $('#data-modal' ).modal  ('show'                );
        });

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
                        url: `${baseUrl}/api/v1/profile/${dataId}`,
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

        $(document).on('click', '#btn-edit', function() {
            let dataId = $(this).data('id');
            $.get(`${baseUrl}/api/v1/profile/` + dataId, function(res) {
                $('#btn-simpan').val("edit-user");
                clearInput()
                $('#data-modal').modal('show');
                $('#id'           ).val(res.data.id           );
                $('#nama_pemilik' ).val(res.data.nama_pemilik );
                $('#nama_usaha'   ).val(res.data.nama_usaha   );
                $('#alamat'       ).val(res.data.alamat       );
                $('#telepon'      ).val(res.data.telepon      );
                $('#foto'         ).val(res.data.foto         );
            });
        });

        $('#btn-simpan').click(function (e) {
            e.preventDefault();
            $(this).html('Menyimpan...');
            $(this).prop('disabled', true);

            let foto = $('#foto').prop('files')[0];
            let data = new FormData($('#formData')[0]);

            $.ajax({
                url: `${baseUrl}/api/v1/profile`,
                method: "POST",
                data: data,
                processData: false,
                contentType: false,
                success: function(res) {
                  Swal.fire({
                    title            : 'Success'               ,
                    text             : 'Data berhasil dihapus',
                    icon             : 'success'               ,
                    cancelButtonColor: '#d33'                  ,
                    confirmButtonText: 'Oke'
                  })
                  $('#data-modal').modal('hide');
                    getAllData()
                },
                error: function(err) {
                    if (err.status === 422) {
                        let data = err.responseJSON
                        let errorRes = data.errors;
                        if (errorRes.length >= 1) {
                            $.each(errorRes.data, (i, d) => {
                                $(`#alert-${i}`).html(d)
                            })
                        }
                        getAllData()
                    } else {
                        let msg = 'Sedang pemeliharaan server';
                        iziToast.error(msg);
                    }
                },
                complete: function() {
                    $('#btn-simpan').html('Simpan');
                    $('#btn-simpan').prop('disabled', false);
                }
            });
        });

        function getAllData() {
            $('#tabledata').DataTable().destroy()
            $.get(`${baseUrl}/api/v1/profile`, (res) => {
                let data = res.data

                $('#tbody').html('')
                $.each(data, (i,d) => {
                    $('#tbody').append(`
                        <tr>
                            <td>${i + 1}</td>
                            <td class="text-capitalize">${d.nama_pemilik}</td>
                            <td class="text-capitalize">${d.nama_usaha}</td>
                            <td class="text-capitalize">${d.alamat}</td>
                            <td class="text-capitalize">${d.telepon}</td>
                            <td class="text-capitalize"><img src="storage/gambar/${d.foto}" alt="Gambar"></td>
                            <td>
                            <button id="btn-edit" data-id="${d.id}" class="btn rounded btn-sm btn-outline-primary mr-1">Edit</button>
                            <button id="btn-hapus" data-id="${d.id}" class="btn rounded btn-sm btn-outline-danger">Hapus</button>
                            </td>
                        </tr>
                    `)
                })

                $('#tabledata').DataTable();
            })
            .fail((err) => {
                iziToast.error({
                    title   : 'Error'                    ,
                    message : 'Server sedang maintenance',
                    position: 'topRight'
                });
            })
        }

        $(document).ready(function() 
        {
            getAllData()
        })
    </script>
@endsection