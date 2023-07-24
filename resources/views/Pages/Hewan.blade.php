@extends('Layout/Base')
@section('content')
<div class="row">
  <div class="col-lg-12 grid-margin stretch-card">
    <div class="card">
      <div class="card-header">
        <h4 class="mt-1" style="float: left"><b>Data Hewan</b></h4>
        <button class="btn btn-primary btn-rounded" style="float: right" id="createData">Tambah Data</button>
      </div>
      <div class="card-body">
        <div class="table-responsive">
          <table class="table table-hover" id="tabledata">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama Usaha</th>
                <th>Jenis Hewan</th>
                <th>Berat</th>
                <th>status</th>
                <th>Harga</th>
                <th>quantity</th>
                <th>Path</th>
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
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
        </div>
        <div class="modal-body">
          <form id="formData" enctype="multipart/form-data">
            <div class="form-group row">
                <input type="hidden" id="id" name="id">
                @hasrole('super-admin')
                <div class="col-sm-12">
                  <label for="exampleInputUsername2" class="col-form-label">Profile</label>
                    <select name="profile_id" id="profile_id" class="form-control val">
                      <option value="" disabled selected>-- Pilih --</option>
                      @foreach ($profil as $j)
                          <option value="{{$j->id}}">{{$j->nama_pemilik}}</option>
                      @endforeach
                    </select>
                    <span class="text-danger text-small alert" id="alert-profile_id"></span>
                </div>
                @endhasrole
                @hasrole('admin')
                  <input type="hidden" class="form-control" id="profile_id" name="profile_id" value="{{Auth::user()->profile_id}}">
                @endhasrole
                <div class="col-sm-6">
                <label for="exampleInputUsername2" class="col-form-label">Jenis Hewan</label>
                  <input type="text" class="form-control val" id="nama" name="nama" placeholder="Input disini">
                  <span class="text-danger text-small alert" id="alert-nama"></span>
                </div>
                <div class="col-sm-6">
                  <label for="exampleInputUsername2" class="col-form-label">Jenis</label>
                    <select name="jenis_id" id="jenis_id" class="form-control val">
                      <option value="" disabled selected>-- Pilih --</option>
                      @foreach ($jenis as $j)
                          <option value="{{$j->id}}">{{$j->nama_jenis}}</option>
                      @endforeach
                    </select>
                    <span class="text-danger text-small alert" id="alert-jenis"></span>
                </div>
                <div class="col-sm-6">
                  <label for="exampleInputUsername2" class="col-form-label">Berat</label>
                    <input type="number" class="form-control val" id="berat" name="berat" placeholder="Input disini">
                    <span class="text-danger text-small alert" id="alert-berat"></span>
                </div>
                <div class="col-sm-6">
                  <label for="exampleInputUsername2" class="col-form-label">Jenis Kelamin</label>
                  <select name="jk" id="jk" class="form-control val">
                    <option value="" selected disabled>-- Pilih --</option>
                    <option value="jantan">Jantan</option>
                    <option value="betina">Betina</option>
                  </select>
                    <span class="text-danger text-small alert" id="alert-jk"></span>
                </div>
                <div class="col-sm-6">
                  <label for="exampleInputUsername2" class="col-form-label">Usia</label>
                    <input type="number" class="form-control val" id="usia" name="usia" placeholder="Input disini">
                    <span class="text-danger text-small alert" id="alert-usia"></span>
                </div>
                <div class="col-sm-6">
                  <label for="exampleInputUsername2" class="col-form-label">Status</label>
                    <select name="status" id="status" class="form-control">
                      <option value="lengkap">Lengkap</option>
                      <option value="tidak lengkap">Tidak Lengkap</option>
                    </select>
                    <span class="text-danger text-small alert" id="alert-status"></span>
                </div>
                <div class="col-sm-6">
                  <label for="exampleInputUsername2" class="col-form-label">Harga</label>
                    <input type="number" class="form-control val" id="harga" name="harga" placeholder="Input disini">
                    <span class="text-danger text-small alert" id="alert-harga"></span>
                </div>
                <div class="col-sm-6">
                  <label for="exampleInputUsername2" class="col-form-label">Discon</label>
                    <select name="harga_id" id="harga_id" class="form-control val">
                      <option value="" disabled selected>-- Pilih --</option>
                      @foreach ($update as $j)
                          <option value="{{$j->id}}">{{$j->harga}}%</option>
                      @endforeach
                    </select>
                </div>
                <div class="col-sm-6">
                  <label for="exampleInputUsername2" class="col-form-label">Quantity</label>
                    <input type="number" class="form-control val" id="quantity" name="quantity" placeholder="Input disini">
                    <span class="text-danger text-small alert" id="alert-quantity"></span>
                </div>
                <div class="col-sm-6">
                  <label for="exampleInputUsername2" class="col-form-label">Path</label>
                    <input type="file" class="form-control val" id="path" name="path" placeholder="Input disini">
                </div>
                <div class="col-sm-12">
                  <label for="exampleInputUsername2" class="col-form-label">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" class="form-control val" rows="8"></textarea>
                    <span class="text-danger text-small alert" id="alert-keterangan"></span>
                </div>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary text-light" onclick="closeModal()">Close</button>
              <button id="btn-simpan" class="btn btn-primary">Save changes</button>
            </form>
        </div>
      </div>
    </div>
  </div>
@endsection
@section('script')
    <script>
        const baseUrl = `{{ config('app.url') }}`

        function clearInput() {
            $('.alert' ).html ('')
            $('.val'   ).val  ('')

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
                title             : 'Apakah anda yakin?',
                text              : "Data tidak dapat dipulihkan!",
                icon              : 'warning',
                showCancelButton  : true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor : '#d33',
                confirmButtonText : 'Yes, hapus!'
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
                        url: `${baseUrl}/api/v1/hewan/${dataId}`,
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
            $.get(`${baseUrl}/api/v1/hewan/` + dataId, function(res) {
                $('#btn-simpan').val("edit-user");
                clearInput()
                $('#data-modal').modal('show');
                $('#id'         ).val(res.data.id         );
                $('#profile_id' ).val(res.data.profile_id );
                $('#nama'       ).val(res.data.nama       );
                $('#jenis_id'   ).val(res.data.jenis_id   );
                $('#berat'      ).val(res.data.berat      );
                $('#jk'         ).val(res.data.jk         );
                $('#usia'       ).val(res.data.usia       );
                $('#status'     ).val(res.data.status     );
                $('#harga'      ).val(res.data.harga      );
                $('#harga_id'   ).val(res.data.harga_id   );
                $('#quantity'   ).val(res.data.quantity   );
                $('#keterangan' ).val(res.data.keterangan );
                $('#path'       ).val(res.data.path       );
            });
        });

        $('#btn-simpan').click(function (e) {
            e.preventDefault();
            $(this).html('Menyimpan...');
            $(this).prop('disabled', true);

            let foto = $('#path').prop('files')[0];
            let data = new FormData($('#formData')[0]);

            $.ajax({
                url: `${baseUrl}/api/v1/hewan`,
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
            $.get(`${baseUrl}/api/v1/hewan`, (res) => {
                let data = res.data

                $('#tbody').html('')
                $.each(data, (i,d) => {
                    $('#tbody').append(`
                        <tr>
                            <td>${i + 1}</td>
                            <td class="text-capitalize">${d.nama}</td>
                            <td class="text-capitalize">${d.nama_jenis}</td>
                            <td class="text-capitalize">${d.berat}</td>
                            <td class="text-capitalize">${d.status}</td>
                            <td class="text-capitalize">${d.harga}</td>
                            <td class="text-capitalize">${d.quantity}</td>
                            <td class="text-capitalize"><img src="storage/gambar/${d.path}" alt="Gambar"></td>
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