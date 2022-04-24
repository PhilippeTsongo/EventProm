
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

      <div class="row mt-4">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Events Management: {{ count($events_all) }}</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
            <div class="table-responsive p-0">
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
                        <p class="text-xs font-weight-bold mb-0">{{ $event->user->name }} </p>
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