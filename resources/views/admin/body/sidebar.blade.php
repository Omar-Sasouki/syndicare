
  <!-- ========== Left Sidebar Start ========== -->
  <div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!-- User details -->

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu</li>

                <li>
                    <a href="{{url ('/dashboard')}}" class="waves-effect">
                        <i class="ri-dashboard-line"></i><span class="badge rounded-pill bg-success float-end"></span>
                        <span>Dashboard</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('users.index')}}" class="waves-effect">
                        <i class="ri-account-circle-line"></i><span class="badge rounded-pill bg-success float-end"></span>
                        <span>Residents</span>
                    </a>
                </li>
               {{--  @role('superadmin') --}}
                <li>
                    <a href="{{route('residence.creation')}}" class="waves-effect">
                        <i class="ri-building-4-fill"></i><span class="badge rounded-pill bg-success float-end"></span>
                        <span>Residences</span>
                    </a>
                </li>
              {{--   @endrole     --}}
                <li>
                    <a href="{{route('devis.creation')}}" class="waves-effect">
                        <i class="ri-building-line"></i><span class="badge rounded-pill bg-success float-end"></span>
                        <span>Devis</span>
                    </a>
                </li>

                <li>
                    <a href="{{route('facture.creation')}}" class="waves-effect">
                        <i class="ri-building-4-line"></i><span class="badge rounded-pill bg-success float-end"></span>
                        <span>Facture</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-mail-send-line"></i>
                        <span>Home Slide Setup</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route ('home.slide')}}">Home Silde</a></li>
                    </ul>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route ('residence.event')}}">Event One</a></li>
                    </ul>
                   {{--  <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route ('residence.event2')}}">Event Two</a></li>
                    </ul>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route ('residence.event3')}}">Event Three</a></li>
                    </ul> --}}
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route ('champ.pub')}}">Champ Pub</a></li>
                    </ul>
                    
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-mail-send-line"></i>
                        <span>Alert</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        @role('superadmin')
                        <li><a href="{{route ('reclamtion.superadmin.index')}}">Reclamtion Personnel</a></li>
                        @endrole
                        @role('admin')
                        <li><a href="{{route('reclamtion.index')}}">Reclamtion Commun</a></li>
                        @endrole
                    </ul>
                </li>
                    </ul>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->

