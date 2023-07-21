@extends('web.skelton.Base')
@section('content')
<section id="home" class="slider-area pt-100">
    <div class="container-fluid position-relative">
        <div class="slider-active">
            @foreach ($data as $d)
                
            <div class="single-slider">
                <div class="slider-bg">
                    <div class="row no-gutters align-items-center ">
                        <div class="col-lg-4 col-md-5">
                            <div class="slider-product-image d-none d-md-block">
                                <img src="{{asset('storage/gambar/'.$d['path'])}}" alt="Slider">
                                <div class="slider-discount-tag">
                                    <p>Harga <br> Spesial</p>
                                </div>
                            </div> <!-- slider product image -->
                        </div>
                        <div class="col-lg-8 col-md-7">
                            <div class="slider-product-content">
                                <h1 class="slider-title mb-10" data-animation="fadeInUp" data-delay="0.3s"><span>Sapi</span> {{$d->nama_jenis}}</h1>
                                <p class="mb-25" data-animation="fadeInUp" data-delay="0.9s">One day however a small line of blind text by the name of Lorem Ipsum decided to leave for the far World of Grammar.</p>
                                <a class="main-btn" href="product.php" data-animation="fadeInUp" data-delay="1.5s">Pesan Sekarang <i class="lni-chevron-right"></i></a>
                            </div> <!-- slider product content -->
                        </div>
                    </div> <!-- row -->
                </div> <!-- container -->
            </div>
            @endforeach
            
        </div> <!-- slider active -->
        <div class="slider-social">
            <div class="row justify-content-end">
                <div class="col-lg-7 col-md-6">
                    <ul class="social text-right">
                        <li><a href="#"><i class="lni-facebook-filled"></i></a></li>
                        <li><a href="#"><i class="lni-twitter-original"></i></a></li>
                        <li><a href="#"><i class="lni-instagram"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div> <!-- container fluid -->
</section>
<section id="Profil" class="showcase-area pt-100 pb-130">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="showcase-title pt-25">
                        <h2 class="title">Tentang Kami</h2>
                    </div> <!-- showcase title -->
                </div> 
                <div class="col-lg-6">
                    <div class="showcase-title pt-25">
                        <p>Terinspirasi masakan khas dari berbagai daerah di Indonesia yang kaya akan rasa dan jenisnya,
                            Naskun Narasa dengan bangga memperkenalkan berbagai produknya yaitu Nasi Kuning dengan sajian aneka
                            Berbagai macam menu, Nasi Kuning dengan pilihan Ayam dan Daging, serta Aneka Nasi Kuning Ekonomis & Lauk Siap Saji dengan pilihan hidangan Indonesia yang lebih beraneka ragam dan lengkap.</p>
                    </div> <!-- showcase title -->
                </div>
            </div>
        </div> <!-- container -->
</section>
<section id="product" class="product-area pt-50 pb-130">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-title text-center pb-25">
                    <h3 class="title mb-15">JENIS SAPI</h3>
                    <p></p>
                </div> <!-- section title -->
            </div>
        </div> <!-- row -->
        <div class="row">
            <div class="col-md-12">
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade show active" id="v-pills-furniture" role="tabpanel" aria-labelledby="v-pills-furniture-tab">
                        <div class="product-items mt-30">
                            <div class="row product-items-active">
                                @foreach ($data as $d)
                                <div class="col-md-4">
                                    <div class="single-product-items">
                                        <div class="product-item-image">
                                            <a href="#"><img src="{{asset('storage/gambar/'.$d['path'])}}" alt="Product" style="width: 100%; height: 280px;"></a>
                                            @if ($d->perubahan_harga == null)
                                                
                                            @else
                                                <div class="product-discount-tag">
                                                    <p>-{{$d->perubahan_harga}}%</p>
                                                </div>
                                            @endif
                                        </div>
                                        <div class="product-item-content text-center mt-15">
                                            <h5 class="product-title"><a href="#" >{{$d->nama_jenis}}</a></h5>
                                            <span class="regular-price mt-1 mb-1" style="">Rp.
                                                {{
                                                    $d->harga - ($d->harga * ($d->perubahan_harga/100))
                                                }}
                                            </span><br>
                                            <a class="main-btn" data-animation="fadeInUp" data-delay="1.5s">Pesan Sekarang <i class="lni-chevron-right"></i></a>
                                        </div>
                                    </div> <!-- single product items -->
                                </div>
                                @endforeach
                            </div> 
                        </div> 
                    </div> 
                </div>  
            </div>
        </div> 
    </div> 
</section>
<section id="testimoni" class="team-area pt-125 pb-130">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="section-title text-center pb-25">
                    <h3 class="title mb-15">TESTIMONI</h3>
                    <p></p>
                </div> 
            </div>
        </div> 
        <div class="row justify-content-center">
            <div class="col-lg-3 col-md-6 col-sm-8">
                <div class="single-temp text-center mt-30">
                    <div class="team-image">
                        <img src="{{asset('template/assets/images/testimoni/admin.jpg')}}"
                         alt="Team">
                    </div>
                    <div class="team-content mt-30">
                        <h4 class="title mb-10"><a href="#">Celina Gomez</a></h4>
                        <p>Saya sangat suka belanja di naskun narasa, karena nasi kuning tersebut sangat enak ya guys yaa</p>
                    </div>
                </div> 
            </div>
            <div class="col-lg-3 col-md-6 col-sm-8">
                <div class="single-temp text-center mt-30">
                    <div class="team-image">
                        <img src="{{asset('template/assets/images/testimoni/admin.jpg')}}"
                         alt="Team">
                    </div>
                    <div class="team-content mt-30">
                        <h4 class="title mb-10"><a href="#">Patric Green</a></h4>
                        <p>Saya sangat suka belanja di naskun narasa, karena nasi kuning tersebut sangat enak ya guys yaa</p>
                    </div>
                </div> 
            </div>
            <div class="col-lg-3 col-md-6 col-sm-8">
                <div class="single-temp text-center mt-30">
                    <div class="team-image">
                        <img src="{{asset('template/assets/images/testimoni/admin.jpg')}}"
                         alt="Team">
                    </div>
                    <div class="team-content mt-30">
                        <h4 class="title mb-10"><a href="#">Mark Parker</a></h4>
                        <p>Saya sangat suka belanja di naskun narasa, karena nasi kuning tersebut sangat enak ya guys yaa</p>
                    </div>
                </div> 
            </div>
            <div class="col-lg-3 col-md-6 col-sm-8">
                <div class="single-temp text-center mt-30">
                    <div class="team-image">
                        <img src="{{asset('template/assets/images/testimoni/admin.jpg')}}"
                         alt="Team">
                    </div>
                    <div class="team-content mt-30">
                        <h4 class="title mb-10"><a href="#">Daryl Dixon</a></h4>
                        <p>Saya sangat suka belanja di naskun narasa, karena nasi kuning tersebut sangat enak ya guys yaa</p>
                    </div>
                </div> 
            </div>
        </div> 
    </div> 
</section>
<section id="contact" class="contact-area pt-115">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="contact-title text-center">
                    <h2 class="title">Hubungi Kami</h2>
                </div> 
            </div>
        </div> 
        <div class="contact-box mt-70">
            <div class="row">
                <div class="col-lg-4">
                    <div class="contact-info pt-25">
                        <h4 class="info-title">Contact Info</h4>
                        <ul>
                            <li>
                                <div class="single-info mt-30">
                                    <div class="info-icon">
                                        <i class="lni-phone-handset"></i>
                                    </div>
                                    <div class="info-content">
                                        <p>+88 1234 56789</p>
                                    </div>
                                </div> 
                            </li>
                            <li>
                                <div class="single-info mt-30">
                                    <div class="info-icon">
                                        <i class="lni-envelope"></i>
                                    </div>
                                    <div class="info-content">
                                        <p>contact@yourmail.com</p>
                                    </div>
                                </div> 
                            </li>
                            <li>
                                <div class="single-info mt-30">
                                    <div class="info-icon">
                                        <i class="lni-home"></i>
                                    </div>
                                    <div class="info-content">
                                        <p>203, Envato Labs, Behind Alis Steet,Australia</p>
                                    </div>
                                </div> 
                            </li>
                        </ul>
                    </div> 
                </div> 
                <div class="col-lg-8">
                    <div class="contact-form">
                        <form id="contact-form" action="template/assets/contact.php" method="post" data-toggle="validator">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="single-form form-group">
                                        <input type="text" name="name" placeholder="Enter Your Name" data-error="Name is required." required="required">
                                        <div class="help-block with-errors"></div>
                                    </div> <!-- single form -->
                                </div>
                                <div class="col-lg-6">
                                    <div class="single-form form-group">
                                        <input type="email" name="email" placeholder="Enter Your Email"  data-error="Valid email is required." required="required">
                                        <div class="help-block with-errors"></div>
                                    </div> <!-- single form -->
                                </div>
                                <div class="col-lg-12">
                                    <div class="single-form form-group">
                                        <textarea name="message" placeholder="Enter Your Message" data-error="Please,leave us a message." required="required"></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div> <!-- single form -->
                                </div>
                                <p class="form-message"></p>
                                <div class="col-lg-12">
                                    <div class="single-form form-group">
                                        <button class="main-btn" type="submit">CONTACT NOW</button>
                                    </div> <!-- single form -->
                                </div>
                            </div> <!-- row -->
                        </form>
                    </div> <!-- row -->
                </div> 
            </div> <!-- row -->
        </div> <!-- contact box -->
    </div> <!-- container -->
</section>

@endsection
@section('script')
    <script>
        // const baseUrl = `{{ config('app.url') }}`

        // function calculate() {
        //     $.get(`${baseUrl}/api/v1/hewan`, function(res) {
        //         let data = res.data;
        //         $('#diskon').html('');
        //         $.each(data, (i, d) => {
        //             let harga = d.harga
        //             let diskon = d.perubahan_harga
        //             let hasil = d.harga - (d.harga * (d.perubahan_harga/100))
        //             console.log(hasil);
        //             $('#diskon').html(`<span class="regular-price mt-1 mb-1" style="">Rp.${hasil}</span><br>`);
        //         });
        //     });
        // }
                

        // $(document).ready(function() 
        // {
        //     calculate()
        // });
    </script>
@endsection