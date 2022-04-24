
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




       
        <div class="page-header min-height-100 border-radius-xl mt-4" style="background-image: url('../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
              <span class="mask bg-gradient-primary opacity-6"></span>
        </div>
        <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
            <div class="row gx-4">
                <div class="col-auto">
                    <div class="avatar avatar-xl position-relative">
                        <img src="../assets/img/bruce-mars.jpg" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
                    </div>
                </div>
                <div class="col-auto my-auto">
                    <div class="h-100">
                        <h5 class="mb-1">
                            {{ $author->name }} &nbsp; {{ $author->last_name }}
                        </h5>
                        <p class="mb-0 font-weight-bold text-sm">
                            {{ $author->email }}
                        </p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
                    <div class="nav-wrapper position-relative end-0">
                        <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">
                            <li class="nav-item">
                                <a href="{{ route('author.show', ['author' => $author->id ])}}" class="nav-link mb-0 px-0 py-1 active " aria-selected="true">
                                    <span class="ms-1">Profile</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('event.myevent')}}" class="nav-link mb-0 px-0 py-1 " aria-selected="false">
                                    <span class="ms-1">Events: {{ count($author->events) }}</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                                    <span class="ms-1">Settings</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        

        <div class="row">

            {{--------- NEAREST EVENT ------------}}
            <div class="col-12 mt-4">
                <div class="card mb-4">
                    <div class="card-header pb-0 p-3">
                        <h6 class="badge badge-sm bg-gradient-primary">Author: &nbsp; {{ $author->name }} {{$author->last_name}}</h6>
                    <p class="text-sm">Events: {{ count($author->events) }}</p>
                    </div>

                    <div class="card-body p-3">
                        <div class="row">
                            @forelse ($author->events as $event)
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
                                            <a href="{{ route('author.show', ['author' => $event->user->id] ) }}">  {{ $event->user->name }} </a><br/>
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
                            <div class="card-body p-3">
                                <div class="row">
                                    <div class="col-xl-3 col-md-6 mb-xl-0 mb-4">
                                        {{ "No incomming Event " }}
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