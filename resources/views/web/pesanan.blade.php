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
                                <label for="" class="label-group">Nama :</label>
                                <input type="text" name="nama" placeholder="Masukan Nama"
                                    data-error="Name is required." required="required">
                                <div class="help-block with-errors"></div>
                            </div> <!-- single form -->
                        </div>
                        <div class="col-lg-6">
                            <div class="single-form form-group">
                                <label for="" class="label-group">Jenis Pesanan :</label>
                                <input type="text" name="jenis_pesanan" placeholder="Masukan Pesanan"
                                    data-error="Valid email is required." required="required">
                                <div class="help-block with-errors"></div>
                            </div> <!-- single form -->
                        </div>
                        <div class="col-lg-6">
                            <div class="single-form form-group">
                                <label for="" class="label-group">Jumlah :</label>
                                <input type="text" name="jumlah" placeholder="Masukan Jumlah"
                                    data-error="Name is required." required="required">
                                <div class="help-block with-errors"></div>
                            </div> <!-- single form -->
                        </div>
                        <div class="col-lg-6">
                            <div class="single-form form-group">
                                <label for="" class="label-group">Harga :</label>
                                <input type="text" name="harga" placeholder="Masukan Harga"
                                    data-error="Valid email is required." required="required">
                                <div class="help-block with-errors"></div>
                            </div> <!-- single form -->
                        </div>
                        <div class="col-lg-12">
                            <div class="single-form form-group">
                                <label for="" class="label-group">Alamat :</label>
                                <textarea name="alamat" cols="30" rows="10"></textarea>
                                <div class="help-block with-errors"></div>
                            </div> <!-- single form -->
                        </div>
                        <div class="col-lg-12">
                            <div class="single-form form-group">
                                <button class="main-btn" type="submit">PESAN SEKARANG</button>
                            </div> <!-- single form -->
                        </div>
                    </div> <!-- row -->
                </form>
            </div> <!-- row -->
        </div>
    </div> <!-- row -->
</div> <!-- contact box -->
@endsection