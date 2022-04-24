<div class="row">
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <a href="{{ route('management.index') }}">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Events</p>
                    <h5 class="font-weight-bolder mb-0">
                      {{ count($events_all) }}
                    </h5>
                </a>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <a href="{{ route('tag.index') }}">
                  <p class="text-sm mb-0 text-capitalize font-weight-bold">Tags</p>
                  <h5 class="font-weight-bolder mb-0">
                    {{ count($tags_all) }}
                  </h5>
                </a>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <a href="{{ route('users.index') }}">
                  <p class="text-sm mb-0 text-capitalize font-weight-bold">Users</p>
                  <h5 class="font-weight-bolder mb-0">
                    {{ count($users_all) }}
                  </h5>
                </a>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="col-xl-3 col-sm-6">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <a href="{{ route('newsletter.index') }}">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">subscribers</p>
                    <h5 class="font-weight-bolder mb-0">
                        {{ count($subscribers_all) }}
                    </h5>
                </a>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>