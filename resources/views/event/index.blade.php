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
              <h6 class="mb-1">Events</h6>
              <p class="text-sm">{{ count($events) }} nearest Events</p>
            </div>
            <div class="card-body p-3">
              <div class="row">

                @forelse ($events as $event)
                <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                  <div class="card card-blog card-plain">
                    <div class="position-relative">
                      <a class="d-inline shadow-xl border-radius-xl" >
                        @if($event->image)
                          <img src=" {{ Storage::url( $event->image->path) }}" alt="{{ $event->title }}" class="img-fluid shadow border-radius-xl"  > 
                        @else 
                          {{"No image for this event"}}
                        @endif  
                      </a>
                    </div>
                    <div class="card-body px-1 pb-0">
                      <p class="text-gradient text-dark mb-2 text-sm">
                        Tags:
                        @forelse($event->tags as $tag)  
                          {{ $tag->name }}
                        @empty
                          {{ 'No tag for this event' }}
                        @endforelse
                      </p>
                      <a href="{{ route('event.show', ['event' => $event->id]) }}"><h5>{{ $event->title }} </h5></a>
                      <p>
                        {{ 'Starting date: '. $event->starts_at->translatedFormat('d M') }}<br/>
                        {{ 'Ending date: '. $event->end_date->translatedFormat('d M') }}<br/>
                        Author:
                        <a href="{{ route('author.show', ['author' => $event->user_id] ) }}">  {{ $event->user->name }} </a><br/>
                      </p>
                      <div class="d-flex align-items-center justify-content-between">
                        <a href="{{ route('event.show', $event) }}" class="btn bg-gradient-dark mb-0">View event</a>
                        <div class="avatar-group mt-2">
                          <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Elena Morison">
                            <img alt="Image placeholder" src="../assets/img/team-1.jpg">
                          </a>
                          <a href="javascript:;" class="avatar avatar-xs rounded-circle" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Ryan Milly">
                            <img alt="Image placeholder" src="../assets/img/team-2.jpg">
                          </a>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                @empty
                    {{ "No incomming Event " }}
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

                <div class="col-xl-5 col-md-6 mb-xl-0 mb-4">
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
          </div>
        </div>

        {{--------------- All Event   ----------------}}
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Events</h6>
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
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>
                    
                    @forelse($events_all as $event_one)
                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="{{ Storage::url( $event_one->image->path )}}" class="avatar avatar-sm me-3" alt="{{ $event_one->title }}">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <a href="{{ route('event.show', $event_one )}}"> <h6 class="mb-0 text-sm">{{ $event_one->title }}</h6></a>
                            <p class="text-xs text-secondary mb-0">
                            @forelse($event_one->tags as $tag)  
                              {{ $tag->name }}
                            @empty
                              {{ 'No tag for this event' }}
                            @endforelse
                            </p>
                          </div>
                        </div>
                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="badge badge-sm bg-gradient-success">{{ $event_one->starts_at->translatedFormat('d M Y') }}</span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="badge badge-sm bg-gradient-warning">{{$event_one->end_date->translatedFormat('d M Y') }}</span>
                      </td>
                      <td>
                        <a href="{{ route('author.show', ['author' => $event_one->user_id] ) }}">
                          <p class="text-xs font-weight-bold mb-0">{{ $event_one->user->name }}</p>
                        </a>
                        <p class="text-xs text-secondary mb-0">{{ $event_one->user->email }}</p>
                      </td>
                      <td>
                        @if( count($event_one->Comments) > '0')
                          {{ count($event_one->comments) . ' comment' }}
                        @else
                          {{ "Not commented yed" }}
                        @endif
                      </td>
                      <td class="align-middle">
                        <a href="javascript:;" class="text-secondary font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user"></a>
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