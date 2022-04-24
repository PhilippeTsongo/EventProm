
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../assets/img/favicon.png">
    <title>
      Soft UI Dashboard by Creative Tim
    </title>
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
    <!-- Nucleo Icons -->
    <link href="../../../assets/css/nucleo-icons.css" rel="stylesheet" />
    <link href="..././assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link href="../assets/css/nucleo-svg.css" rel="stylesheet" />
    <!-- CSS Files -->
    <link id="pagestyle" href="../../assets/css/soft-ui-dashboard.css?v=1.0.5" rel="stylesheet" />
  </head>

<body class="g-sidenav-show  bg-gray-100">
  
  @include('partials.aside')

  
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->

    @include('partials.navbar')

    <!-- End Navbar -->
    <div class="container-fluid py-4">

      <div class="row my-4">
        <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
          <div class="card">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-lg-12 col-7">
                  <h5>Edit a user</h5>
                  <p class="text-sm mb-0">
                    <i class="fa fa-check text-info" aria-hidden="true"></i>
                    Fill the form below to edit a user 
                  </p>
                </div>
              </div>
            </div>
            <div class="card-body px-4 pb-2">  
              <form method="post" action="{{ route('users.update', $user ) }}" class="col-lg-12 col-md-6 mb-md-0 mb-4">
                @csrf  
                @method('PUT')
                {{---- DISPLAY THE SUCCESS MESSAGE ----}}
                @if(session()->has('message'))
                  <span class="alert alert-success">  {{ session()->get('message')  }} </span>
                  <hr>
                @endif
                {{---- DISPLAY THE ERROR MESSAGES ----}}
                @if($errors->any())
                  @foreach($errors->all() as $error)
                    <span class="alert alert-danger"> {{ $error }} </span>
                  @endforeach
                  <hr>
                @endif
                <div class="row">
                  <div class="col-md-12">
                    <x-label for="title" value="Enter the tag name" />
                    <div class="mb-3">
                      <x-input id="name" name="name" type="text" :value="old('name') ?? $user->name" class="form-control" />
                    </div>
                    <x-label for="email" value="email"/>
                    <div class="mb-3">
                      <x-input id="email" name="email" type="eamil" :value="old('email') ?? $user->email" class="form-control" />
                    </div>                            
                  </div>
                </div>
                <div class="block">
                    <x-button type="submit" class="btn bg-gradient-dark mt-4 mb-0"> Edit a user</x-button>
                </div>
                <br/>        
              </form>
            </div>
          </div>
        </div> 
      </div>  
      
      @include('partials.footer')

    </div>
  </main>
  
  @include('partials.config')

  <!--   Core JS Files   -->
  <script src="../../assets/js/core/popper.min.js"></script>
  <script src="../../assets/js/core/bootstrap.min.js"></script>
  <script src="../../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script src="../../assets/js/plugins/chartjs.min.js"></script>
  
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.5"></script>
</body>

</html>