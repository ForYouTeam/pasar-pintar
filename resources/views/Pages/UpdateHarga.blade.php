@extends('Layout/Base')
@section('content')
<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-header">
        <h4 class="mt-1" style="float: left"><b>Data Perubahan Harga</b></h4>
        <button class="btn btn-primary btn-rounded" style="float: right" id="createData">Tambah Data</button>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover" id="tabledata">
            <thead>
              <tr>
                <th>No</th>
                <th>Code</th>
                <th>Harga</th>
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
              <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Code harga</label>
              <div class="col-sm-9">
                <input type="number" class="form-control" id="code" name="code" placeholder="Input disini">
                <span class="text-danger text-small" id="alert-code"></span>
              </div>
              <label for="exampleInputUsername2" class="col-sm-3 col-form-label">Harga</label>
              <div class="col-sm-9">
                <input type="number" class="form-control mt-3" id="harga" name="harga" placeholder="Input disini">
                <span class="text-danger text-small" id="alert-harga"></span>
              </div>
            </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary text-light" onclick="closeModal()">Close</button>
          <button id="btn-simpan" onclick="postData()" class="btn btn-primary">Save changes</button>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('script')
    <script>
        const baseUrl = `{{ config('app.url') }}`

        function clearInput() {
          $('#code' ).val('')
          $('#harga').val('')
          $('#alert-code').html('')
          $('#alert-harga').html('')
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
                        url: `${baseUrl}/api/v1/update_harga/${dataId}`,
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
            clearInput()
            let dataId = $(this).data('id')
            $.get(`${baseUrl}/api/v1/update_harga/${dataId}`, (res) => {
                let data = res.data
                $.each(data, (i,d) => {
                    if (i != "created_at" && i != "updated_at") {
                        $(`#${i}`).val(d)
                    }
                })
                $('#data-modal').modal('show')
            }).fail((err) => {
                iziToast.error({
                    title   : 'Error'                    ,
                    message : 'Server sedang maintenance',
                    position: 'topRight'
                });
            })
        })

        function postData() {
            const data = {
                id    : $('#id'    ).val(),
                code  : $('#code'  ).val(),
                harga : $('#harga' ).val(),
            }

            $.ajax({
                url        : `${baseUrl}/api/v1/update_harga/`,
                method     : "POST"                   ,
                data       : data                     ,
                success: function(res) {
                    $('#data-modal').modal('hide')
                    Swal.fire({
                      title            : 'Success'               ,
                      text             : 'Data berhasil ditambahkan',
                      icon             : 'success'               ,
                      cancelButtonColor: '#d33'                  ,
                      confirmButtonText: 'Oke'
                    })
                    getAllData()
                },
                error: function(err) {
                    if (err.status = 422) {
                        let data = err.responseJSON
                        let errorRes = data.errors;
                        if (errorRes.length >= 1) {
                            $.each(errorRes.data, (i, d) => {
                                $(`#alert-${i}`).html(d)
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
            $('#tabledata').DataTable().destroy()
            $.get(`${baseUrl}/api/v1/update_harga`, (res) => {
                let data = res.data

                $('#tbody').html('')
                $.each(data, (i,d) => {
                    $('#tbody').append(`
                        <tr>
                            <td>${i + 1}</td>
                            <td class="text-capitalize">${d.code}</td>
                            <td class="text-capitalize">${d.harga}</td>
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