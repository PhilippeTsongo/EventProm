
<!DOCTYPE html>
<html lang="en">

@include('partials.head')

<body class="g-sidenav-show  bg-gray-100">
  
  @include('partials.aside')

  
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <!-- Navbar -->

    @include('partials.navbar')

    <!-- End Navbar -->
    <div class="container-fluid py-4">

      <div class="row">
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
      </div>

      <div class="row my-4">
        <div class="col-lg-8 mb-md-0 mb-4">
          <div class="card">
            <div class="card-header pb-0 px-3">
              <h6 class="mb-0">My events: {{ count($my_events )}}</h6>
            </div>
           
            <div class="row">
              @forelse($my_events as $my_event)    
              <div class="col-lg-6">
                <div class="card-body pt-2 p-3">
                  <ul class="list-group">
                    <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                      <div class="d-flex flex-column">
                        <a href="{{ route('event.show', $my_event) }}"> <h6 class="mb-3 text-sm">{{ $my_event->title }}</h6></a>
                        <span class="mb-2 text-xs">Tags: {{ count($my_event->tags) }} 
                          @forelse($my_event->tags as $tag)
                            <span class="text-dark font-weight-bold ms-sm-2"> {{ $tag->name }}</span>
                            @empty
                              {{ "No tag for this event" }}
                          @endforelse
                        </span>
                        <span class="mb-2 text-xs">Starts at: <span class="text-dark ms-sm-2 font-weight-bold">{{ $my_event->starts_at->format('d M Y') }}</span></span>
                        <span class="text-xs">Ends at: <span class="text-dark ms-sm-2 font-weight-bold">{{ $my_event->end_date->format('d M Y') }}</span></span>
                        <span class="text-xs">Comments: 
                          <span class="text-dark ms-sm-2 font-weight-bold">
                            @if($my_event->comments)
                              {{ count($my_event->comments) }}
                            @else
                              {{ "0 comment" }}
                            @endif
                          </span>
                        </span>
                      </div>
                      <div class="ms-auto text-end">
                        <form action="{{ route('event.destroy', $my_event) }}" method="post" onsubmit="return confirm('Do you really want to delete this event');" >
                          {{ csrf_field() }}
                          {{ method_field('DELETE')}} 
                          <button class="badge badge-sm bg-gradient-warning" id="button" type="submit" style="border:none;">Delete </button>
                        </form>  
                        <hr>                 
                        <a href=" {{ route('event.edit', $my_event) }} " method="GET" onsubmit="return confirm('Do you really want to edit this event');" class="badge badge-sm bg-gradient-primary">Edit</a>
                      </div>
                    </li>
                  </ul>
                </div>
              </div>
              @empty
                {{ "You haven't created an event yet" }}
              @endforelse
            </div>
          </div>
        </div>

        
          <div class="col-lg-4">
            <div class="row">
              <div class="card h-auto p-3">
                  <div class="overflow-hidden position-relative border-radius-lg bg-cover h-100" style="background-image: url('../assets/img/ivancik.jpg');">
                      <span class="mask bg-gradient-dark"></span>
                      <div class="card-body position-relative z-index-1 d-flex flex-column h-100 p-3">
                          <h5 class="text-white font-weight-bolder mb-4 pt-2">Work with the rockets</h5>
                          <p class="text-white">Wealth creation is an evolutionarily recent positive-sum game. It is all about who take the opportunity first.</p>
                          <a class="text-white text-sm font-weight-bold mb-0 icon-move-right mt-auto" href="javascript:;">
                              Read More
                              <i class="fas fa-arrow-right text-sm ms-1" aria-hidden="true"></i>
                          </a>
                      </div>
                  </div>
              </div>
            </div>
            <hr>
            <div class="row">
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