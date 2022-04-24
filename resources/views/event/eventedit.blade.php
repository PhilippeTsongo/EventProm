
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
        <div class="col-lg-8 col-md-6 mb-md-0 mb-4">
          <div class="card">
            <div class="card-header pb-0">
              <div class="row">
                <div class="col-lg-12 col-7">
                  <h6>Edit an event</h6>
                  <p class="text-sm mb-0">
                    <i class="fa fa-check text-info" aria-hidden="true"></i>
                    Fill the form below to let edit this event  
                  </p>
                </div>
              </div>
            </div>
            <div class="card-body px-4 pb-2">  
              <form method="post" action="{{ route('event.update', $event ) }}" enctype="multipart/form-data" class="col-lg-12 col-md-6 mb-md-0 mb-4">
                @csrf  
                @method('PUT')
                
                <div class="row">
                  <div class="col-md-6">
                    <x-label for="title" value="Enter the title" />
                    <div class="mb-3">
                      <x-input id="title" name="title" type="text" :value="old('title') ?? $event->title" class="form-control" />
                    </div>  
                  </div>
                  <div class="col-md-6">
                    <x-label for="tags" value="Enter the tags. separate them with commas"/>
                    <div class="mb-3">
                      @forelse($event->tags as $tag)
                        <x-input id="tags" name="tags" type="text" :value="old('tags') ?? $tag->name" class="form-control"/>
                      @empty
                        <x-input id="tags" name="tags" type="text" :value="old('tags') ?? $tag->name" class="form-control"/>
                      @endforelse    
                    </div> 
                  </div>
                </div>

                <x-label for="content" value="Enter a short description " />
                <div class="mb-3">
                  <textarea id="content" name="content" class="form-control">{{ $event->content}} </textarea>
                </div>  
                <x-label for="premium" value="Premium ?" />
                <div class="mb-3">
                  <x-input id="premium" name="premium" type="checkbox" :value="old('premuim') ?? $event->premium"/>
                </div>  
                <div class="row">
                  <div class="col-md-6">
                    <x-label for="strats_at" value="Enter the starting date" />
                    <div class="mb-3">  
                      <x-input id="strats_at" name="starts_at" type="date" :value="old('starts_at') ?? $event->starts_at" class="form-control"/>
                    </div>
                  </div>  
                  <div class="col-md-6">
                    <x-label for="end_date" value="Enter the ending date" />
                    <div class="mb-3">
                      <x-input id="end_date" name="end_date" type="date" :value="old('end_date') ?? $event->ends_date" class="form-control"/>
                    </div>
                  </div>
                </div>    
                <x-label for="EventFile" value="Chose the file." />
                <div class="mb-3">
                  <x-input id="EventFile" name="EventFile" type="file" :value="old('EventFile') ?? $event->image->path" class="form-control" />
                </div>
                <div class="block">
                    <x-button type="submit" class="btn bg-gradient-dark mt-4 mb-0"> Edit the event</x-button>
                </div>
                <br/>        
              </form>
            </div>
          </div>
        </div>
        
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
                      <button class="badge badge-sm bg-gradient-warning" id="button" type="submit" style="border:none;">Delete </button>
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