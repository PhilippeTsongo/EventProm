
<!DOCTYPE html>
<html lang="en">

@include('partials.head')

<body class="g-sidenav-show  bg-gray-100">
 
  @include('partials.aside') 

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    
    @include('partials.navbar')

    {{--------------- ALL EVENT MANAGEMENT   ----------------}}
    <div class="container-fluid py-4">
  
      @include('partials.dashboardbar')

      <div class="row">
        {{--------ERROR  MESSAGE--------}}    
        @if(session()->has('message'))
            <br/>
            <span class="alert alert-success">  {{ session()->get('message')  }} </span>
        @endif
      </div>  

      <div class="row mt-4">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Events Management: {{ count($events_all) }}</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
              {{--------ERROR  MESSAGE--------}}    
              @if(session()->has('message'))
                <span class="alert alert-success">  {{ session()->get('message')  }} </span>
              @endif
              <table class="table align-items-center mb-0">
                <thead>
                  <tr>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Events</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Starts at</th>
                    <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">End at</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Authors</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Comments</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Edit</th>
                    <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Delete</th>
                  </tr>
                </thead>
                <tbody>
                            
                  @forelse($events_all as $event)
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="{{ Storage::url( $event->image->path )}}" class="avatar avatar-sm me-3" alt="{{ $event->title }}">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <a href="{{ route('event.show', $event )}}"> <h6 class="mb-0 text-sm">{{ $event->title }}</h6></a>
                            <p class="text-xs text-secondary mb-0">
                              @forelse($event->tags as $tag)  
                                {{ $tag->name }}
                              @empty
                                {{ 'No tag for this event' }}
                              @endforelse
                            </p>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-primary">{{ $event->starts_at->translatedFormat('d M Y') }}</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="badge badge-sm bg-gradient-warning">{{$event->end_date->translatedFormat('d M Y') }}</span>
                      </td>
                      <td>
                        <a href="{{ route('author.show', ['author' => $event->user_id] ) }}">
                          <p class="text-xs font-weight-bold mb-0">{{ $event->user->name }} </p>
                        </a>
                        <p class="text-xs text-secondary mb-0">{{ $event->user->email }}</p>
                      </td>
                      <td>
                        @if( count($event->Comments) > '0')
                          {{ count($event->comments) . ' comment' }}
                        @else
                          {{ "No comment" }}
                        @endif
                      </td>
                      <td>
                        <a href="{{ route('management.edit', ['management' =>$event->id] ) }}" _method="GET" onSubmit="return confirm('Do you really want to edit this event?');" class="badge badge-sm bg-gradient-primary">Edit</a>
                      </td>                                      
                      <td>
                        <form action="{{ route('management.destroy', ['management' =>$event->id ] ) }}" method="POST" onsubmit="return confirm('Do you really want to delete this event?');">
                          {{ csrf_field() }}
                          {{ method_field('DELETE') }}
                          <button type="submit" class="badge badge-sm bg-gradient-warning" style="border:none;" >Delete</button>
                        </form>
                      </td>
                    </tr>
                    @empty
                      {{ "No event" }}
                    @endforelse
                  </tbody>
                </table>
                <div class="card-header pb-0">
                  <h6> {{ $events_all->links('vendor.pagination.bootstrap-5') }}</h6>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

      @include('partials.footer')


    </div>
</main>
<div class="fixed-plugin">
    <a class="fixed-plugin-button text-dark position-fixed px-3 py-2">
      <i class="fa fa-cog py-2"> </i>
    </a>
    <div class="card shadow-lg ">
      <div class="card-header pb-0 pt-3 ">
        <div class="float-start">
          <h5 class="mt-3 mb-0">Soft UI Configurator</h5>
          <p>See our dashboard options.</p>
        </div>
        <div class="float-end mt-4">
          <button class="btn btn-link text-dark p-0 fixed-plugin-close-button">
            <i class="fa fa-close"></i>
          </button>
        </div>
        <!-- End Toggle Button -->
      </div>
      <hr class="horizontal dark my-1">
      <div class="card-body pt-sm-3 pt-0">
        <!-- Sidebar Backgrounds -->
        <div>
          <h6 class="mb-0">Sidebar Colors</h6>
        </div>
        <a href="javascript:void(0)" class="switch-trigger background-color">
          <div class="badge-colors my-2 text-start">
            <span class="badge filter bg-gradient-primary active" data-color="primary" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-dark" data-color="dark" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-info" data-color="info" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-success" data-color="success" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-warning" data-color="warning" onclick="sidebarColor(this)"></span>
            <span class="badge filter bg-gradient-danger" data-color="danger" onclick="sidebarColor(this)"></span>
          </div>
        </a>
        <!-- Sidenav Type -->
        <div class="mt-3">
          <h6 class="mb-0">Sidenav Type</h6>
          <p class="text-sm">Choose between 2 different sidenav types.</p>
        </div>
        <div class="d-flex">
          <button class="btn bg-gradient-primary w-100 px-3 mb-2 active" data-class="bg-transparent" onclick="sidebarType(this)">Transparent</button>
          <button class="btn bg-gradient-primary w-100 px-3 mb-2 ms-2" data-class="bg-white" onclick="sidebarType(this)">White</button>
        </div>
        <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
        <!-- Navbar Fixed -->
        <div class="mt-3">
          <h6 class="mb-0">Navbar Fixed</h6>
        </div>
        <div class="form-check form-switch ps-0">
          <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed" onclick="navbarFixed(this)">
        </div>
        <hr class="horizontal dark my-sm-4">
        <a class="btn bg-gradient-dark w-100" href="https://www.creative-tim.com/product/soft-ui-dashboard">Free Download</a>
        <a class="btn btn-outline-dark w-100" href="https://www.creative-tim.com/learning-lab/bootstrap/license/soft-ui-dashboard">View documentation</a>
        <div class="w-100 text-center">
          <a class="github-button" href="https://github.com/creativetimofficial/soft-ui-dashboard" data-icon="octicon-star" data-size="large" data-show-count="true" aria-label="Star creativetimofficial/soft-ui-dashboard on GitHub">Star</a>
          <h6 class="mt-3">Thank you for sharing!</h6>
          <a href="https://twitter.com/intent/tweet?text=Check%20Soft%20UI%20Dashboard%20made%20by%20%40CreativeTim%20%23webdesign%20%23dashboard%20%23bootstrap5&amp;url=https%3A%2F%2Fwww.creative-tim.com%2Fproduct%2Fsoft-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-twitter me-1" aria-hidden="true"></i> Tweet
          </a>
          <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.creative-tim.com/product/soft-ui-dashboard" class="btn btn-dark mb-0 me-2" target="_blank">
            <i class="fab fa-facebook-square me-1" aria-hidden="true"></i> Share
          </a>
        </div>
      </div>
    </div>
  </div>
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