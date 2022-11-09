<!DOCTYPE html>
<html lang="en">

@include('partials.head')

<body class="g-sidenav-show  bg-gray-100">
 
  @include('partials.aside') 

  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    
    @include('partials.navbar')
    <div class="container-fluid py-4">
        <div class="row">
            {{-------SUCCESS MESSAGE-------}}
            @if(session()->has('message'))
                <span class="alert alert-success">  {{ session()->get('message')  }} </span>
            @endif
            {{------ ERROR MESSAGES --------}}
            @if($errors->any())
                @foreach($errors->all() as $error)
                    <span class="alert alert-danger"> {{ $error }} </span>
                @endforeach
            @endif
        </div>
        <div class="row">
            <div class="col-md-1 mb-xl-2 mb-4"></div>
            <div class="col-md-6 mt-4">
                <div class="card mb-4">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-xl-4s col-md-1 mb-xl-0 mb-4"></div>
                            <div class="col-xl-4s col-md-10 mb-xl-0 mb-4">
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
                                        <div class="row">
                                            <div class="col-md-8">
                                                <p class="text-gradient text-dark mb-2 text-sm">
                                                    Tags: ({{ count($event->tags) }})
                                                    @foreach ($event->tags as $tag)
                                                        {{  $tag->name }} 
                                                    @endforeach
                                                </p>
                                                <a href="{{ route('event.show', ['event' => $event->id]) }}"><h5>{{ $event->title }} </h5></a>
                                                <p>
                                                    {{ 'Starting date: '. $event->starts_at->translatedFormat('d M') }}<br/>
                                                    {{ 'Ending date: '. $event->end_date->translatedFormat('d M') }}<br/>
                                                </p>
                                            </div>
                                            <div class="col-md-4">
                                                Author: 
                                                <a href="{{ route('author.show', ['author' => $event->user_id] ) }}">
                                                    {{ $event->user->name }}
                                                </a> <br/>
                                                Comment: 
                                                @if($event->comments)
                                                    {{ count($event->comments) }}
                                                @else
                                                    {{ "No comment for this event" }}
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-4s col-md-1 mb-xl-0 mb-4"></div>
                        </div>
                    </div>
                </div>
                {{-------DISPLAY THE EVENT IN SAME CATEGORY-----}}
                <div class="row">
                    <div class="col-lg-12">
                        <div class="card h-100 p-3">
                            <div class="card-header pb-0">
                                <h6>Related Events (with same tags) </h6>
                            </div>
                            <div class="col-xl-12">
                                <div class="row">
                                    @if(!empty($tag->events))
                                    @if(count($tag->events) > 1)
                                    @forelse($tag->events as $event)  
                                    <div class="col-md-6 mt-2">
                                        <div class="card">
                                            <div class="card-header mx-4 p-3 text-center">
                                                <div class="d-inline shadow-xl border-radius-xl" >
                                                <img  class="img-fluid shadow border-radius-xl" src="{{ Storage::url($event->image->path) }}" />
                                                </div>
                                            </div>
                                            <div class="card-body pt-0 p-3 text-center">
                                                <h6 class="text-center mb-0">{{ $event->title }}</h6>
                                                <span class="text-xs">
                                                    {{ $event->starts_at->format('d M Y') . ' | ' . $event->end_date->format('d M Y') }}
                                                </span>
                                                <hr class="horizontal dark my-3">
                                                <a class="btn bg-gradient-dark mb-0" href="{{ route('event.show', $event) }}">View event</a>
                                            </div>
                                        </div>
                                    </div>
                                    @empty
                                        {{ 'No related event by tags'}}
                                    @endforelse
                                    @else
                                        {{ "No related event" }}
                                    @endif
                                    @else
                                        {{ 'This event has no tag'}}
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                </div>

            </div>
            
            <div class="col-md-4 mt-4">
                <div class="card h-auto">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Comments:  {{ count($event->comments ) }} </h6>
                    </div>
                    <div class="card-body p-3">
                        <ul class="list-group">
                        
                            @forelse($event->comments as $comment)
                            <li class="list-group-item border-0 d-flex align-items-center px-0 mb-2">
                                <div class="avatar me-3">
                                <img src="../assets/img/kal-visuals-square.jpg" alt="kal" class="border-radius-lg shadow">
                                </div>
                                <div class="d-flex align-items-start flex-column justify-content-center">
                                <h6 class="mb-0 text-sm"> {{ $comment->name }}</h6>
                                <p class="mb-0 text-xs">{{ $comment->comment }}</p>
                                </div>
                                <a class="btn btn-link pe-3 ps-0 mb-0 ms-auto" href="#reply">Reply</a>
                            </li>
                            @empty
                                <b class="alert alert-warning">{{ 'No comment for this event' }}</b>
                            @endforelse
                        </ul>
                    </div>       
                </div>
                <div class="col-md-12 mt-4">
                    <div class="card h-auto">
                        <div class="card-header pb-0 p-3">
                            <h6 class="mb-0" id="reply">Leave a comment</h6>
                        </div>

                        <div class="card-body p-3">
                            <form action="{{ route('comment.edit', $event) }}" method="post"  >
                                @csrf
                                {{ method_field("GET") }}
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <input type="email" class="form-control" name="email" :value="old('email')" placeholder="Email *" aria-label="Email" aria-describedby="email-addon">
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <input type="text" class="form-control" name="name" :value="old('name')" placeholder="Name *" aria-label="Password" aria-describedby="password-addon">
                                    </div>
                                </div>
                                <div class="md-3">
                                    <textarea class="form-control" name="comment" placeholder="Write you comment here *" :value="old('comment')"></textarea>
                                </div><br/>
                                <div class="mb-3">
                                    <input type="text" class="form-control" name="website" :value="old('website')" placeholder="Website" aria-label="Password" aria-describedby="password-addon">
                                </div>
                                
                                <div class="text-center">
                                <input type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0" value="Submit your comment">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-1 mb-xl-2 mb-4"></div>
            
        </div>    
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
