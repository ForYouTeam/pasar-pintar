@extends('Layout.Base')
@section('content')
    

<div class="">
  <div class="row">
    <div class="col-lg-3">
      <div class="card mx-1">
        <div class="card-body">
          <div>
            <p class="statistics-title"><b>Hewan</b></p>
            <h3 class="rate-percentage">{{$data['hewan']}}%</h3>
            <p class="text-success d-flex"><i class="mdi mdi-dog-side"></i><span>&nbsp; TOTAL</span></p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="card mx-1">
        <div class="card-body">
          <div>
            <p class="statistics-title"><b>Profil</b></p>
            <h3 class="rate-percentage">{{$data['profil']}}%</h3>
            <p class="text-success d-flex"><i class="mdi mdi-account-edit"></i><span>&nbsp; TOTAL</span></p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="card mx-1">
        <div class="card-body">
          <div>
            <p class="statistics-title"><b>Jenis Hewan</b></p>
            <h3 class="rate-percentage">{{$data['jenis']}}%</h3>
            <p class="text-success d-flex"><i class="mdi mdi-book"></i><span>&nbsp; TOTAL</span></p>
          </div>
        </div>
      </div>
    </div>
    <div class="col-lg-3">
      <div class="card mx-1">
        <div class="card-body">
          <div>
            <p class="statistics-title"><b>Akun</b></p>
            <h3 class="rate-percentage">{{$data['user']}}%</h3>
            <p class="text-success d-flex"><i class="mdi mdi-cash"></i><span>&nbsp; TOTAL</span></p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>



@endsection