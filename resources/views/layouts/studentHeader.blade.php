<!DOCTYPE html>
<html lang="en" data-bs-theme="auto">

@include('layouts.header')

<body>
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
                <li class="nav-item"><a href="{{ route('student.page',['id' => session('student_id')]) }}" class="nav-link text-white" aria-current="page"><i class="bi bi-house-door me-2"></i> Home</a></li>
                <li><a href="{{ route('student.page',['id' => session('student_id')]) }}" class="nav-link text-white"><i class="bi bi-speedometer2 me-2"></i> Dashboard</a></li>
                @if(session()->has('student_id'))
                <li><a href="{{ route('student.fees.payment.open.page', ['id' => session('student_id')]) }}" class="nav-link text-white"><i class="bi bi-table me-2"></i> Fees Payment</a></li>
                @endif
                <li><a href="{{ route('student.page',['id' => session('student_id')]) }}" class="nav-link text-white"><i class="bi bi-grid me-2"></i> Borrowed Books</a></li>
                <li><a href="{{ route('student.page',['id' => session('student_id')]) }}" class="nav-link text-white"><i class="bi bi-person-circle me-2"></i> Library Access</a></li>
                <li>
                    <form action="{{ route('logout')  }}" id="signOut" method="GET" style="display:inline;">

                        <button type="button" class="nav-link text-white" onclick="alertMessage(event,'signOut',null)"><i class="bi bi-box-arrow-right"></i> Sign out</button>
                    </form>
                </li>
            </ul>

        </div>
    </div>
    <style>
        .table-modern th {
            background-color: rgba(110, 81, 145, 0.8);
            color: rgb(0, 0, 0);
            font-weight: bold;
        }


        .accordion-button:not(.collapsed) {
            color: rgb(0, 0, 0);
            background-color: rgba(110, 81, 145, 0.8);
            font-weight: bold;
            box-shadow: none;
        }
.nav-li a{
    text-decoration: none;
}
.nav-li:hover {
    background-color: #512E5F;

}
    </style>
    <!-- -------------------------------------------------------------------------------------------------------------------------------------------- -->