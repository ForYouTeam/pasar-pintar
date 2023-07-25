@extends('web.skelton.Base')
@section('content')
<div class="contact-box mt-120">
    <div class="row">
        <div class="col-lg-12">
            <center>
                <h3>Form Pesanan</h3>
            </center>
            <div class="contact-form">
                <form id="contact-form" action="insert_product.php" method="post" data-toggle="validator">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="single-form form-group">
                                <label for="" class="label-group">Nama:</label>
                                <input id="nama" type="text" placeholder="Masukan Nama"
                                    data-error="Name is required." required="required">
                                <div class="help-block with-errors"></div>
                            </div> <!-- single form -->
                        </div>
                        <div class="col-lg-6">
                            <div class="single-form form-group">
                                <label for="" class="label-group">Alamat :</label>
                                <input id="alamat" type="text" placeholder="Masukan Pesanan"
                                    data-error="Valid email is required." required="required">
                                <div class="help-block with-errors"></div>
                            </div> <!-- single form -->
                        </div>
                        <div class="col-lg-6">
                            <div class="single-form form-group">
                                <label for="" class="label-group">Jenis :</label>
                                <input id="jenis" type="text" placeholder="Masukan Jumlah"
                                    data-error="Name is required." required="required">
                                <div class="help-block with-errors"></div>
                            </div> <!-- single form -->
                        </div>
                        <div class="col-lg-6">
                            <div class="single-form form-group">
                                <label for="" class="label-group">Harga :</label>
                                <input id="harga" type="text" placeholder="Masukan Harga"
                                    data-error="Valid email is required." required="required">
                                <div class="help-block with-errors"></div>
                            </div> <!-- single form -->
                        </div>
                        <div class="col-lg-12">
                            <div class="single-form form-group">
                                <label for="" class="label-group">Keterangan :</label>
                                <textarea id="keterangan" cols="30" rows="10"></textarea>
                                <div class="help-block with-errors"></div>
                            </div> <!-- single form -->
                        </div>
                        <div class="col-lg-12">
                            <div class="single-form form-group">
                                <button class="main-btn" type="button" id="btn-process">PESAN SEKARANG</button>
                            </div> <!-- single form -->
                        </div>
                    </div> <!-- row -->
                </form>
            </div> <!-- row -->
        </div>
    </div> <!-- row -->
</div> <!-- contact box -->
@endsection
@section('script')
    <script>
        $(document).on('click', '#btn-process', function() {
            const nama       = $('#nama').val()
            const alamat     = $('#alamat').val()
            const jenis      = $('#jenis').val()
            const harga      = $('#harga').val()
            const keterangan = $('#keterangan').val()
            const nomor      = '6282189037993'

            const whatsappMessage = `nama: ${nama}\nalamat: ${alamat}\njenis%sapi: ${jenis}\nharga: ${harga}\nketerangan: ${keterangan}`;
            const encodedMessage  = encodeURIComponent(whatsappMessage);
            const whatsappLink    = `https://wa.me/${nomor}?text=${encodedMessage}`;
            
            window.location.href  = whatsappLink
        })
    </script>
@endsection
