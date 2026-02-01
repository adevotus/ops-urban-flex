<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link {{ request()->routeIs('manager.dashboard.*') ? 'active' : '' }}"
               data-toggle="collapse"
               href="#managerDashboard"
               aria-expanded="{{ request()->routeIs('manager.dashboard.*') ? 'true' : 'false' }}">
                <i class="icon-grid menu-icon"></i>
                <span class="menu-title">Dashboard</span>
                <i class="menu-arrow"></i>
            </a>

            <div class="collapse {{ request()->routeIs('manager.dashboard.*') ? 'show' : '' }}"
                 id="managerDashboard">
                <ul class="nav flex-column sub-menu">

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('manager.dashboard.vehicle') ? 'active' : '' }}" href="{{ route('manager.dashboard.vehicle') }}">Vehicle Landing</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('manager.dashboard.property') ? 'active' : '' }}" href="{{ route('manager.dashboard.property') }}">Property Rental
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->routeIs('manager.dashboard.debit') ? 'active' : '' }}" href="{{ route('manager.dashboard.debit') }}">Debit Collections
                        </a>
                    </li>


                </ul>
            </div>
        </li>



        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#auth" aria-expanded="false" aria-controls="auth">
                <i class="icon-head menu-icon"></i>
                <span class="menu-title">Users</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="auth">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="#">Operations</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('manager.owner-list')}}"> Owners </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('manager.driver-list')}}"> Drivers </a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('manager.landLord_list')}}"> LandLords</a></li>
                    <li class="nav-item"> <a class="nav-link" href="{{route('manager.shopOwner_list')}}"> ShopOwners</a></li>

                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#icons" aria-expanded="false" aria-controls="icons">
                <i class="icon-contract menu-icon"></i>
                <span class="menu-title">Loans</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="icons">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('manager.loan-list')}}">Vehicle</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Property</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false" aria-controls="tables">
                <i class="icon-grid-2 menu-icon"></i>
                <span class="menu-title">Agreements</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="tables">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="{{route('manager.agreement-list')}}">Vehicle</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Property</a></li>
                </ul>
            </div>
        </li>

        <li class="nav-item">
            <a class="nav-link  {{ request()->routeIs('manager.vehicle-list') ? 'active' : '' }}" href="{{route('manager.vehicle-list')}}">
                <i class="icon-contract menu-icon"></i>
                <span class="menu-title">Vehicles</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" href="{{route('manager.owner_transactions_list')}}">
                <i class="icon-paper menu-icon"></i>
                <span class="menu-title">Payments</span>
            </a>
        </li>

        <li class="nav-item">
            <a class="nav-link" data-toggle="collapse" href="#charts" aria-expanded="false" aria-controls="charts">
                <i class="icon-bar-graph menu-icon"></i>
                <span class="menu-title">Reports</span>
                <i class="menu-arrow"></i>
            </a>
            <div class="collapse" id="charts">
                <ul class="nav flex-column sub-menu">
                    <li class="nav-item"> <a class="nav-link" href="#">Repayments</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">Loans</a></li>
                    <li class="nav-item"> <a class="nav-link" href="#">General Reports</a></li>
                </ul>
            </div>
        </li>





    </ul>
</nav>
