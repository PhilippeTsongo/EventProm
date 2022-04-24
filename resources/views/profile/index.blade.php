<!DOCTYPE html>
<html lang="en">

@include('partials.head')

<body class="g-sidenav-show bg-gray-100">
  
  @include('partials.aside')
  
  <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
    <!-- Navbar -->
    
    @include('partials.navbar')
    
    @include('partials.profilebar')
    
    <div class="container-fluid py-4">

      <div class="row">
        {{---- DISPLAY THE SUCCESS MESSAGE ----}}
        @if(session()->has('message'))
          <span class="alert alert-success"  style="color: white;">  {{ session()->get('message')  }} </span>
          <hr>
        @endif
        {{---- DISPLAY THE ERROR MESSAGES ----}}
        @if($errors->any())
          @foreach($errors->all() as $error)
            <span class="alert alert-danger"  style="color: white;"> {{ $error }} </span>
          @endforeach
          <hr>
        @endif
      </div>


      <div class="row p-3">
        <div class="col-lg-4">
          <div class="card h-auto">
            <div class="card-header pb-0 p-3">
              <div class="row">
                <div class="col-md-8 d-flex align-items-center">
                  <h6 class="mb-0">Profile Information</h6>
                </div>
                <div class="col-md-4 text-end">
                  <a href="javascript:;">
                    <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                  </a>
                </div>
              </div>
            </div>
            <div class="card-body p-3">
              <p class="text-sm">
               
                {{ $auth_user->intro }}   
                
              </p>
              <hr class="horizontal gray-light my-2">
              <ul class="list-group">
                <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Name:&nbsp; {{ $auth_user->name }}</strong> </li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Last Name:&nbsp; {{ $auth_user->last_name }} </strong></li>

                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:&nbsp; {{ $auth_user->email }} </strong></li>
                <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Location:&nbsp; {{ $auth_user->location }}</strong></li>
              </ul>
              
              <a href=" {{ route('profile.edit', ['profile' => $auth_user]) }} " method="GET" onsubmit="return confirm('Do you really want to edit your profile information');" class="badge badge-sm bg-gradient-primary">Edit</a>
              
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          <div class="card h-auto">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-0">My events: {{ count($my_events) }}</h6>
            </div>
            <div class="card-body p-3">
              <ul class="list-group">

                @forelse($my_events as $my_event)
                <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                  <div class="avatar me-3">
                    <a href="{{ route('event.show', $my_event )}}">
                      <img src="{{ Storage::url($my_event->image->path) }}" alt="kal" class="border-radius-lg shadow">
                    </a>  
                    </div>
                  <div class="d-flex align-items-start flex-column justify-content-center">
                    <a href="{{ route('event.show', $my_event )}}">
                      <h6 class="mb-0 text-sm">{{ $my_event->title }}</h6>
                    </a>
                    <p class="mb-0 text-xs">{{ $my_event->starts_at->format('d M Y') }} | {{ $my_event->end_date->format('d M Y') }}</p>
                    <p class="mb-0 text-xs">Comment: {{ count($my_event->comments) }}</p>
                  </div>
                </li>
                @empty 
                  <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                    <b>{{ "You have no event" }}</b>
                  </li>
                @endforelse
              </ul>
            </div>
          </div>
        </div>
        <div class="col-lg-4">
          
            <div class="card h-auto p-3">
                <div class="overflow-hidden position-relative border-radius-lg bg-cover h-100" style="background-image: url('../assets/img/ivancik.jpg');">
                    <span class="mask bg-gradient-dark"></span>
                    <div class="card-body position-relative z-index-1 d-flex flex-column h-100 p-3">
                        <h5 class="text-white font-weight-bolder mb-4 pt-2">ADD A NEW EVENT</h5>
                        <p class="text-white">Let people know about the nearest events you're preparing</p>
                        <a href="{{ route('event.create') }}" class="btn btn-white btn-sm w-100 mb-0">New event</a>
                    </div>
                </div>
            </div>
          
        </div>
      </div>
      
      @include('partials.footer')

    </div>
  </div>
  
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
  <!-- Github buttons -->
  <script async defer src="https://buttons.github.io/buttons.js"></script>
  <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/soft-ui-dashboard.min.js?v=1.0.5"></script>
</body>

</html>