 {{-- <!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-book fa-solid"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Duty Diary</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item 
        {{ request()->is('admin') ? 'active' : '' }}
    ">
        <a class="nav-link" href="/admin">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

   
  

    <!-- Nav Item - DIARIES -->
    <li class="nav-item 
        {{ request()->is('diaries') ? 'active' : '' }}
    ">
        <a class="nav-link" href="{{ route('diaries.index')}}">
            <i class="fas fa-solid fa-book-open"></i>
            <span>Diaries</span></a>
    </li>

    <!-- Nav Item - DOCUMENTATIONS -->
    <li class="nav-item 
        {{ request()->is('documentations') ? 'active' : '' }}
    ">
        <a class="nav-link" href="{{route('documentations.index')}}">
            <i class="fas fa-solid fa-camera-retro"></i>
            <span>Documentations</span></a>
    </li>

    
     

     <!-- Nav Item - APPROVAL -->
     <li class="nav-item 
        {{ request()->is('approval-requests') ? 'active' : '' }}
    ">
         <a class="nav-link" href="{{route('approval-requests.index')}}">
            <i class="fas fa-solid fa-check-double"></i>
             <span>Approval Requests</span>
        </a>
     </li>

    

    <!-- Nav Item - USERS -->
    <li class="nav-item 
        {{ request()->is('users') ? 'active' : '' }}
    ">
        <a class="nav-link" href="{{ route('users.index') }}">
            <i class="fas fa-solid fa-users"></i>
            <span>Users</span>
        </a>
    </li>

</ul>
<!-- End of Sidebar --> --}}

<!-- Sidebar -->
<style>
    /* Style for normal state */
    .navbar-nav .nav-item .nav-link {
        color: white;
        transition: all 0.3s ease; /* Adding smooth transition */
    }

    /* Style for hover state */
    .navbar-nav .nav-item .nav-link:hover {
        color: black;
        background-color: white;
        transition: all 0.3s ease; /* Adding smooth transition */
    }

    /* Style for active state */
    .navbar-nav .nav-item.active .nav-link {
        color: black;
        background-color: white;
        transition: all 0.3s ease; /* Adding smooth transition */
    }

    .navbar-nav .nav-item .nav-link i {
    margin-right: 10px; /* Adding space between icon and text */
    color: inherit; /* Inherit the text color to match */
    transition: all 0.3s ease; /* Adding smooth transition */
}
/* Style for the icon in normal state */
.navbar-nav .nav-item .nav-link i {
    margin-right: 10px; /* Adding space between icon and text */
    color: inherit; /* Inherit the text color to match */
    transition: all 0.3s ease; /* Adding smooth transition */
}

/* Style for the icon on hover state */
.navbar-nav .nav-item .nav-link:hover i {
    color: black; /* Change icon color on hover */
}
</style>

<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index.html">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-book fa-solid"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Duty Diary</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item 
        {{ request()->is('admin') ? 'active' : '' }}
    ">
        <a class="nav-link" href="/admin">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span>
        </a>
    </li>

    <!-- Nav Item - DIARIES -->
    <li class="nav-item 
        {{ request()->is('diaries') ? 'active' : '' }}
    ">
        <a class="nav-link" href="{{ route('diaries.index') }}">
            <i class="fas fa-solid fa-book-open"></i>
            <span>Diaries</span>
        </a>
    </li>

    <!-- Nav Item - DOCUMENTATIONS -->
    <li class="nav-item 
        {{ request()->is('documentations') ? 'active' : '' }}
    ">
        <a class="nav-link" href="{{ route('documentations.index') }}">
            <i class="fas fa-solid fa-camera-retro"></i>
            <span>Documentations</span>
        </a>
    </li>

    <!-- Determine user role -->
    {{-- @php
        $userRole = auth()->user()->role; // Assuming you can retrieve the user's role ID
    @endphp --}}

    <!-- Display items for trainees -->
    {{-- @if ($userRole == 3) <!-- Assuming role_id 3 is for trainees -->
        <!-- Nav Item - APPROVAL (Hidden for trainees) -->
    @else --}}
    @if(Session::get('USERROLE') == 1 || Session::get('USERROLE') == 2)
        <li class="nav-item {{ request()->is('approval-requests') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('approval-requests.index') }}">
                <i class="fas fa-solid fa-check-double"></i>
                <span>Approval Requests</span>
            </a>
        </li>
     @endif
        @if(Session::get('USERROLE') == 1)
        <!-- Nav Item - USERS (Hidden for trainees) -->
        <li class="nav-item {{ request()->is('users') ? 'active' : '' }}">
            <a class="nav-link" href="{{ route('users.index') }}">
                <i class="fas fa-solid fa-users"></i>
                <span>Users</span>
            </a>
        </li>
    {{-- @endif --}}
    @endif
</ul>
<!-- End of Sidebar -->
