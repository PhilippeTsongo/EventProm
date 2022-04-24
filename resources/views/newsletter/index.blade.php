
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

        <div class="row mt-5">
            <div class="col-12">
                <div class="card mb-4">
                    <div class="card-header pb-0">
                        <h6>Subscribers Management</h6>
                    </div>
                    <div class="card-body px-0 pt-0 pb-2">
                        <div class="table-responsive p-4">
                            {{--------ERROR  MESSAGE--------}}    
                            @if(session()->has('message'))
                                <br/>
                                <span class="alert alert-success">  {{ session()->get('message')  }} </span>
                            @endif
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Email</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Edit</th>
                                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Delete</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($subscribers_all as $subscriber)
                                    <tr>
                                        <td class="align-middle text-center">
                                            <span class="badge badge-sm bg-gradient-warning">{{ $subscriber->id }}</span>
                                        </td>
                                        <td>
                                            <a href="{{ route('author.show', ['author' => $subscriber->id] ) }}">
                                                <p class="text-xs font-weight-bold mb-0">{{ $subscriber->name }} </p>
                                            </a>
                                        </td>
                                        <td>
                                            <p class="text-xs text-secondary mb-0">
                                            {{ $subscriber->email }}
                                            </p>
                                        </td>
                                        <td>
                                            <a href="{{ route('newsletter.edit', $subscriber ) }}" _method="GET" onSubmit="return confirm('Do you really want to edit this tag?');" class="badge badge-sm bg-gradient-primary">Edit</a>
                                        </td>                                      
                                        <td>
                                            <form action="{{ route('newsletter.destroy', ['newsletter' => $subscriber->id ] ) }}" method="POST" onsubmit="return confirm('Do you really want to delete this tag?');">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                                <button type="submit" class="badge badge-sm bg-gradient-danger" style="border:none;" >Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @empty
                                    {{ "No tag" }}
                                    @endforelse
                                </tbody>
                            </table>
                            <div class="card-header pb-0">
                                <h6> {{ $subscribers_all->links('vendor.pagination.bootstrap-5') }}</h6>
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