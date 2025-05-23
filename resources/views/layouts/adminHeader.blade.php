<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">

@include('layouts.header')

<body>

    <!-- <main class="container-fluid p-4"> -->
        <nav class="navbar navbar-dark bg-dark fixed-top">
            <div class="container-fluid">

                <a class="navbar-brand"><img id="logo" src="{{ asset('images/datacore-logo.png') }}"></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarMenu" aria-controls="sidebarMenu">
                    <span class="navbar-toggler-icon"></span>
                </button>
            </div>
        </nav>
        <div class="offcanvas offcanvas-start text-bg-dark" tabindex="-1" id="sidebarMenu" aria-labelledby="sidebarMenuLabel">
            <div class="offcanvas-header">
                <h5 class="offcanvas-title" id="sidebarMenuLabel">Data-Core</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>

            <div class="offcanvas-body d-flex flex-column p-3">
                <ul class="nav nav-pills flex-column mb-auto">
                    <li class="nav-li"><a href="{{ route('admin.page') }}" class=" text-white"><i class="bi bi-house-door me-2"></i><span> Home</span></a></li><br>
                    <li class="nav-li"><a href="{{ route('admin.payment.panel') }}" class=" text-white"><i class="bi bi-calendar3"></i><span> Payment Schedule</span></a></li><br>
                    <li class="nav-li"><a href="{{ route('admin.panel')}}" class=" text-white"><i class="bi bi-table me-2"></i><span> Student Dashboard</span></a></li><br>
                    <li class="nav-li"><a href="{{ route('admin.fees.payments') }}" class=" text-white"><i class="bi bi-map"></i><span> Fees Payments</span></a></li><br>
                    <li class="nav-li"><a href="{{ route('admin.browse') }}" class=" text-white"><i class="bi bi-map"></i><span> Browse</span></a></li><br>
                    <li class="nav-li"><a href="{{ route('admin.fees.panel') }}" class=" text-white"><i class="bi bi-arrow-up-right-circle"></i><span> Fees Management</span></a></li><br>
                    <li class="nav-li"><a href="{{ route('admin.head.panel') }}" class=" text-white"><i class="bi bi-grid me-2"></i><span> Fees Heads</span></a></li><br>
                    <li class="nav-li">
                        <form action="{{ route('logout') }}" id="signOut" method="GET" style="display:inline;">

                            <button type="button" class="nav-link text-white" onclick="alertMessage(event,'signOut',null)"><i class="bi bi-box-arrow-right"></i> Sign out</button>
                        </form>
                        
                    </li>

                </ul>
                
            </div>
        </div>
        <style>
    .table-modern th {
        background-color:rgba(110, 81, 145, 0.8);
        color:rgb(0, 0, 0);
        font-weight: bold;
    }


    .accordion-button:not(.collapsed) {
        color:rgb(0, 0, 0);
    background-color: rgba(110, 81, 145, 0.8);
    font-weight: bold;
    box-shadow: none;
}
            </style>
        <!-- -------------------------------------------------------------------------------------------------------------------------------------------- -->