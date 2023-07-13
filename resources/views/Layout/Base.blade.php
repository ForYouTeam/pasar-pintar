<!DOCTYPE html>
<html lang="en">

<head>
    @include('Layout.Top')
</head>
<body>
  <div class="container-scroller"> 
    @include('Layout.Nav')

      <!-- partial -->
      <!-- partial:partials/_sidebar.html -->
      @include('Layout.Sidebar')
      <!-- partial -->
      <div class="main-panel">
        <div class="content-wrapper">
          @yield('content')
        </div>
        <!-- content-wrapper ends -->
        <!-- partial:partials/_footer.html -->
        <footer class="footer">
          <div class="d-sm-flex justify-content-center justify-content-sm-between">
            <span class="text-muted text-center text-sm-left d-block d-sm-inline-block">Premium <a href="https://www.bootstrapdash.com/" target="_blank">Bootstrap admin template</a> from BootstrapDash.</span>
            <span class="float-none float-sm-right d-block mt-1 mt-sm-0 text-center">Copyright © 2021. All rights reserved.</span>
          </div>
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>

  @include('Layout.Bottom')
  @yield('script')
</body>

</html>

