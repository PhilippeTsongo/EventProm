
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

      {{-- SUCCEESS MESSAGE --}}
      <div class="row">
        @if(session()->has('message'))
          <span class="alert alert-success">  {{ session()->get('message')  }} </span>
          <hr>
        @endif
        {{-- ERROR MESSAGE --}}
        @if($errors->any())
          @foreach($errors->all() as $error)
            <span class="alert alert-danger"> {{ $error }} </span>
          @endforeach
          <hr>
        @endif
      </div>
      <div class="row my-4">
        <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
          <div class="card">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-lg-12 col-7">
                  <h6>Create a new event</h6>
                  <p class="text-sm mb-0">
                    <i class="fa fa-check text-info" aria-hidden="true"></i>
                    Fill the form below to let people know about a certain great event 
                  </p>
                </div>
              </div>
            </div>
            <div class="card-body px-4 pb-2">  
              <form method="post" action="{{ route('event.store') }}" enctype="multipart/form-data" class="col-lg-12 col-md-6 mb-md-0 mb-4">
                @csrf  
                
                <div class="row">
                  <div class="col-md-6">
                    <x-label for="title" value="Enter the title *" />
                    <div class="mb-3">
                      <x-input id="title" name="title" type="text" :value="old('title')" class="form-control" />
                    </div>  
                  </div>
                  <div class="col-md-6">
                    <x-label for="tags" value="Enter the tags. separate them with commas"/>
                    <div class="mb-3">
                      <x-input id="tags" name="tags" type="text" :value="old('tags')" class="form-control"/>
                    </div> 
                  </div>
                </div>

                <x-label for="content" value="Enter a short description of the event" />
                <div class="mb-3">
                  <textarea id="content" name="content" :value="old('content')" class="form-control"> </textarea>
                </div>  
                <x-label for="premium" value="Premium ?" />
                <div class="mb-3">
                  <x-input id="premium" name="premium" type="checkbox" :value="old('premuim')"/>
                </div>  
                <div class="row">
                  <div class="col-md-6">
                    <x-label for="strats_at" value="Enter the starting date *" />
                    <div class="mb-3">  
                      <x-input id="strats_at" name="starts_at" type="date" :value="old('starts_at')" class="form-control"/>
                    </div>
                  </div>  
                  <div class="col-md-6">
                    <x-label for="end_date" value="Enter the ending date *" />
                    <div class="mb-3">
                      <x-input id="end_date" name="end_date" type="date" :value="old('end_date')" class="form-control"/>
                    </div>
                  </div>
                </div>    
                <x-label for="EventFile" value="Chose the file." />
                <div class="mb-3">
                  <x-input id="EventFile" name="EventFile" type="file" :value="old('EventFile')" class="form-control" />
                </div>
                <div class="block">
                    <x-button type="submit" class="btn bg-gradient-dark mt-4 mb-0" > Create the event</x-button>
                </div>
                <br/>        
              </form>
            </div>
          </div>
        </div>
        
        {{--------- DISPLAY THE ONLINE USER'S EVENTS -----------}}
        <div class="col-lg-4 mb-md-0 mb-4">
          <div class="card">
            <div class="card-header pb-0 px-3">
              <h6 class="mb-0">My events: {{ count($my_events )}}</h6>
            </div>
            @forelse($my_events as $my_event)
            <div class="card-body pt-4 p-3">
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
                      <button class="badge badge-sm bg-gradient-warning" id="button" type="submit">Delete </button>
                    </form>  
                    <hr>                 
                    <a href=" {{ route('event.edit', $my_event) }} " method="GET" onsubmit="return confirm('Do you really want to edit this event');" class="badge badge-sm bg-gradient-primary">Edit</a>
                  </div>
                </li>
              </ul>
            </div>
            @empty
              {{ "You haven't created an event yet" }}
            @endforelse
          </div>
        </div>
      </div>  
      
      {{--------------- All Event   ----------------}}
      <div class="row">
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
                        <p class="text-xs font-weight-bold mb-0">{{ $event_one->user->name }}</p>
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
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  
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