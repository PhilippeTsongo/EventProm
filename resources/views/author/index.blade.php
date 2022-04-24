
<!DOCTYPE html>
<html lang="en">

@include('partials.head')

<body class="g-sidenav-show  bg-gray-100">
 
  @include('partials.aside') 

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    
    @include('partials.navbar')

    {{-- SUCCEESS MESSAGE --}}
    @if(session()->has('message'))
      <span class="alert alert-success">  {{ session()->get('message')  }} </span>
      <hr>
    @endif
    {{-- ERROR MESSAGE --}}
    @if($errors->any())
      @foreach($errors->all() as $error)
        <span class="alert alert-danger">  {{ $error }} </span>
      @endforeach
    @endif
    <div class="container-fluid py-4">
        <div class="row">
            {{--------- NEAREST EVENT ------------}}
            <div class="col-12 mt-4">
                <div class="card mb-4">
                    <div class="card-header pb-0 p-3">
                        <h6 class="badge badge-sm bg-gradient-primary">users: &nbsp; {{ count($users_all) }}</h6>
                    {{-- <p class="text-sm">Events: {{ count($author->events) }}</p> --}}
                    </div>

                    <div class="card-body p-3">
                        <div class="row">
                            @forelse ($users_all as $user)
                            <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                                <div class="card card-blog card-plain">
                                    <div class="position-relative">
                                    <a class="d-inline shadow-xl border-radius-xl" >
                                        @if($user->image)
                                        <img src=" {{ Storage::url( $user->image->path) }}" alt="{{ $user->name }}" class="img-fluid shadow border-radius-xl"  > 
                                        @else 
                                        {{"No image for this user"}}
                                        @endif  
                                    </a>
                                    </div>
                                    <div class="card-body px-1 pb-0">
                                        <p class="text-gradient text-dark mb-2 text-sm">
                                            Events:{{ count($user->events) }}
                                        </p>
                                        <a href="{{ route('author.show', ['author' => $user->id]) }}"><h5>{{ $user->name . ' ' . $user->last_name}} </h5></a>
                                        <p>{{ 'Location :' . $user->location }}<br/></p>
                                        <div class="d-flex align-items-center justify-content-between">
                                            <a href="{{ route('author.show', ['author' => $user->id ]) }}" class="btn bg-gradient-dark mb-0">{{ $user->name }}'s events</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                                        {{ "No User yet " }}
                                    </div>
                                </div>
                            </div>        
                            @endforelse

                            <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                                <div class="card h-100 card-plain border">
                                    <div class="card-body d-flex flex-column justify-content-center text-center">
                                    <a href="{{ route('event.create')}}">
                                        <i class="fa fa-plus text-secondary mb-3"></i>
                                        <h5 class=" text-secondary"> New Event </h5>
                                    </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        @include('partials.footer')

    </div>
  </main>
  
  @include('partials.config')  

  <!--   Core JS Files   -->
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.min.js"></script>
  <script src="../assets/js/plugins/smooth-scrollbar.min.js"></script>
  <script>
    var win = navigator.platform.indexOf('Win') > -1;
    if (win && document.querySelector('#sidenav-scrollbar')) {
      var options = {
        damping: '0.5'
      }
      Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
    }
  </script>
  
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.5"></script>
</body>

</html>