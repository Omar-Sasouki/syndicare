<header id="page-topbar">
    <div class="navbar-header">
        <div class="d-flex">
            <!-- LOGO -->
            <div class="navbar-brand-box">
                <a href="{{ url('/dashboard') }}" class="logo logo-dark">
                    <span class="logo-sm">
                        <img src="{{ asset('backend/assets/images/logo-Syndiacre.png') }}" alt="logo-Syndiacre"
                            height="40">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('backend/assets/images/logo-Syndiacre.png') }}" alt="logo-Syndiacre"
                            height="70">
                    </span>
                </a>

                <a href="{{ url('/dashboard') }}" class="logo logo-light">
                    <span class="logo-sm">
                        <img src="{{ asset('backend/assets/images/logo-Syndiacre.png') }}" alt="logo-Syndiacre"
                            height="40">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('backend/assets/images/logo-Syndiacre.png') }}" alt="logo-Syndiacre"
                            height="70">
                    </span>
                </a>
            </div>

            <button type="button" class="btn btn-sm px-3 font-size-24 header-item waves-effect" id="vertical-menu-btn">
                <i class="ri-menu-2-line align-middle"></i>
            </button>
        </div>

        <div class="d-flex">

            <div class="dropdown d-inline-block d-lg-none ms-2">
                <button type="button" class="btn header-item noti-icon waves-effect" id="page-header-search-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="ri-search-line"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-search-dropdown">

                    <form class="p-3">
                        <div class="mb-3 m-0">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Search ...">
                                <div class="input-group-append">
                                    <button class="btn btn-primary" type="submit"><i class="ri-search-line"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            @php
                $id = Auth::user()->id;
                $adminData = App\Models\User::findOrFail($id);
            @endphp

            <div class="dropdown d-none d-lg-inline-block ms-1">
                <button type="button" class="btn header-item noti-icon waves-effect" data-toggle="fullscreen">
                    <i class="ri-fullscreen-line"></i>
                </button>
            </div>

            <div class="dropdown d-inline-block">
                <button type="button" class="btn header-item noti-icon waves-effect"
                    id="page-header-notifications-dropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="bg-success rounded-circle">{{ Auth::user()->unreadNotifications->count() }}</div>
                    <i class="ri-notification-3-line"></i>
                </button>

                <div class="dropdown-menu dropdown-menu-lg dropdown-menu-end p-0"
                    aria-labelledby="page-header-notifications-dropdown">
                    <div class="p-3">
                        <div class="row align-items-center">
                            <div class="col">
                                <h6 class="m-0"> Notifications ({{ Auth::user()->unreadNotifications->count() }})
                                </h6>
                            </div>
                        </div>
                    </div>
                    <div data-simplebar style="max-height: 230px;">

                        @foreach (Auth::user()->unreadNotifications->filter(function ($notification) {
        return $notification->type === App\Notifications\ReclamtionPersonnel::class;
    }) as $not)
                            @php
                                $created_at = $not->created_at;
                                $current_time = now();
                                $minutes_passed = $created_at->diffInMinutes($current_time);
                            @endphp
                            <a href="" class="text-reset notification-item">
                                <div class="d-flex">

                                    <div class="avatar-xs me-3">
                                        <span class="avatar-title bg-success rounded-circle font-size-16">
                                            <i class="ri-message-2-fill"></i>
                                        </span>
                                    </div>
                                    <div class="flex-1">
                                        <h6 class="mb-1">{{ $not->data['create_reclamation'] }}</h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1">{{ $not->data['RSA'] }}</p>

                                            <p class="mb-0"><i
                                                    class="mdi mdi-clock-outline"></i>{{ $minutes_passed }} minutes ago
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <a href="#"
                                    onclick="event.preventDefault(); document.getElementById('mark-as-read-{{ $not->id }}').submit();">Mark
                                    as Read</a>
                                <form id="mark-as-read-{{ $not->id }}"
                                    action="{{ route('notifications.mark-as-read', $not->id) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </a>
                        @endforeach

                        @foreach (Auth::user()->unreadNotifications->filter(function ($notification) {
        return $notification->type === App\Notifications\ReclamtionCommun::class;
    }) as $not)
                            @php
                                $created_at = $not->created_at;
                                $current_time = now();
                                $minutes_passed = $created_at->diffInMinutes($current_time);
                            @endphp
                            <a href="" class="text-reset notification-item">
                                <div class="d-flex">

                                    <div class="avatar-xs me-3">
                                        <span class="avatar-title bg-primary rounded-circle font-size-16">
                                            <i class="ri-time-line"></i>
                                        </span>
                                    </div>
                                    <div class="flex-1">
                                        <h6 class="mb-1">{{ $not->data['message9'] }}</h6>
                                        <div class="font-size-12 text-muted">
                                            {{--  <p class="mb-1">{{ $not->data['residence']['event_title2'] }}</p> --}}

                                            <p class="mb-0"><i
                                                    class="mdi mdi-clock-outline"></i>{{ $minutes_passed }} minutes ago
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <a href="#"
                                    onclick="event.preventDefault(); document.getElementById('mark-as-read-{{ $not->id }}').submit();">Mark
                                    as Read</a>
                                <form id="mark-as-read-{{ $not->id }}"
                                    action="{{ route('notifications.mark-as-read', $not->id) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </a>
                        @endforeach


                        @foreach (Auth::user()->unreadNotifications->filter(function ($notification) {
        return $notification->type === App\Notifications\SetConfimationDateNotification::class;
    }) as $not)
                            @php
                                $created_at = $not->created_at;
                                $current_time = now();
                                $minutes_passed = $created_at->diffInMinutes($current_time);
                            @endphp
                            <a href="" class="text-reset notification-item">
                                <div class="d-flex">

                                    <div class="avatar-xs me-3">
                                        <span class="avatar-title bg-primary rounded-circle font-size-16">
                                            <i class="ri-time-line"></i>
                                        </span>
                                    </div>
                                    <div class="flex-1">
                                        <h6 class="mb-1">{{ $not->data['message3'] }}</h6>
                                        <div class="font-size-12 text-muted">
                                            {{--  <p class="mb-1">{{ $not->data['residence']['event_title2'] }}</p> --}}

                                            <p class="mb-0"><i
                                                    class="mdi mdi-clock-outline"></i>{{ $minutes_passed }} minutes
                                                ago
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <a href="#"
                                    onclick="event.preventDefault(); document.getElementById('mark-as-read-{{ $not->id }}').submit();">Mark
                                    as Read</a>
                                <form id="mark-as-read-{{ $not->id }}"
                                    action="{{ route('notifications.mark-as-read', $not->id) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </a>
                        @endforeach

                        @foreach (Auth::user()->unreadNotifications->filter(function ($notification) {
        return $notification->type === App\Notifications\PaymentReminderNotification::class;
    }) as $not)
                            @php
                                $created_at = $not->created_at;
                                $current_time = now();
                                $minutes_passed = $created_at->diffInMinutes($current_time);
                            @endphp
                            <a href="" class="text-reset notification-item">
                                <div class="d-flex">
                                    <div class="avatar-xs me-3">
                                        <span class="avatar-title bg-primary rounded-circle font-size-16">
                                            <i class="ri-shopping-cart-line"></i>
                                        </span>
                                    </div>
                                    <div class="flex-1">
                                        <h6 class="mb-1">{{ $not->data['message4'] }}</h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1"></p>
                                            <p class="mb-1"></p>
                                            <p class="mb-0"><i
                                                    class="mdi mdi-clock-outline"></i>{{ $minutes_passed }} minutes
                                                ago </p>
                                        </div>
                                    </div>
                                </div>
                                <a href="#"
                                    onclick="event.preventDefault(); document.getElementById('mark-as-read-{{ $not->id }}').submit();">Mark
                                    as Read</a>
                                <form id="mark-as-read-{{ $not->id }}"
                                    action="{{ route('notifications.mark-as-read', $not->id) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </a>
                            </a>
                        @endforeach

                        @foreach (Auth::user()->unreadNotifications->filter(function ($notification) {
        return $notification->type === App\Notifications\TableUpdatedNotification::class;
    }) as $not)
                            @php
                                $created_at = $not->created_at;
                                $current_time = now();
                                $minutes_passed = $created_at->diffInMinutes($current_time);
                            @endphp
                            <a href="" class="text-reset notification-item">
                                <div class="d-flex">
                                    <div class="avatar-xs me-3">
                                        <span class="avatar-title bg-primary rounded-circle font-size-16">
                                            <i class="ri-shopping-cart-line"></i>
                                        </span>
                                    </div>
                                    <div class="flex-1">
                                        <h6 class="mb-1">{{ $not->data['message1'] }}</h6>
                                        <div class="font-size-12 text-muted">
                                            <p class="mb-1"></p>
                                            <p class="mb-1"></p>
                                            <p class="mb-0"><i
                                                    class="mdi mdi-clock-outline"></i>{{ $minutes_passed }} minutes
                                                ago </p>
                                        </div>
                                    </div>
                                </div>
                                <a href="#"
                                    onclick="event.preventDefault(); document.getElementById('mark-as-read-{{ $not->id }}').submit();">Mark
                                    as Read</a>
                                <form id="mark-as-read-{{ $not->id }}"
                                    action="{{ route('notifications.mark-as-read', $not->id) }}" method="POST"
                                    style="display: none;">
                                    @csrf
                                </form>
                            </a>
                        @endforeach

                    </div>
                    <div class="p-2 border-top">
                        <div class="d-grid">

                        </div>
                    </div>
                </div>
            </div>

            <div class="dropdown d-inline-block user-dropdown">
                <button type="button" class="btn header-item waves-effect" id="page-header-user-dropdown"
                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <img class="rounded-circle header-profile-user"
                        src="{{ !empty($adminData->profile_image)
                            ? url('upload/admin_images/' . $adminData->profile_image)
                            : url('upload/no_image.jpg') }}"
                        alt="Header Avatar">
                    <span class="d-none d-xl-inline-block ms-1">{{ $adminData->name }}</span>
                    <i class="mdi mdi-chevron-down d-none d-xl-inline-block"></i>
                </button>
                <div class="dropdown-menu dropdown-menu-end">
                    <!-- item-->
                    <a class="dropdown-item" href="{{ route('admin.profile') }}"><i
                            class="ri-user-line align-middle me-1"></i> Profile</a>
                    <a class="dropdown-item" href="{{ route('admin.password') }}"><i class="ri-lock-line"></i>
                        Change Password</a>
                    <a class="dropdown-item d-block" href="#"><span
                            class="badge bg-success float-end mt-1">11</span><i
                            class="ri-settings-2-line align-middle me-1"></i> Settings</a>
                    <a class="dropdown-item" href="#"><i class="ri-lock-unlock-line align-middle me-1"></i>
                        Lock screen</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item text-danger" href="{{ route('admin.logout') }}"><i
                            class="ri-shut-down-line align-middle me-1 text-danger"></i> Logout</a>
                </div>
            </div>
        </div>
    </div>
</header>
