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
                    <li class="nav-li"><a href="{{ route('admin.page') }}" class=" text-white"><i class="bi bi-house-door me-2"></i> Home</a></li><br>
                    <li class="nav-li"><a href="{{ route('admin.page') }}" class=" text-white"><i class="bi bi-grid me-2"></i> Profile</a></li><br>
                    <li class="nav-li"><a href="{{ route('admin.panel')}}" class=" text-white"><i class="bi bi-table me-2"></i> Student Dashboard</a></li><br>
                    <li class="nav-li"><a href="{{ route('admin.page') }}" class=" text-white"><i class="bi bi-map"></i> Browse Courses</a></li><br>
                    <li class="nav-li"><a href="{{ route('admin.page') }}" class=" text-white"><i class="bi bi-arrow-up-right-circle"></i> Skill Assessment</a></li><br>
                    <li class="nav-li">
                        <form action="{{ route('logout')     }}" id="signOut" method="GET" style="display:inline;">

                            <button type="button" class="nav-link text-white" onclick="alertMessage(event,'signOut',null)"><i class="bi bi-box-arrow-right"></i> Sign out</button>
                        </form>
                    </li>

                </ul>
                <hr class="dropdown-divider">
            </div>
        </div>
        <!-- -------------------------------------------------------------------------------------------------------------------------------------------- -->