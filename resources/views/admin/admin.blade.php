@include('layouts.adminHeader')



<style>
    .carousel-item img {
        width: 100px;
        height: 500px;
        object-fit: cover;
    }

    .carousel {
        box-shadow: 0px 0px 30px rgba(0, 0, 0, 0.9);
    }
</style>

<div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
        <div class="carousel-item active">
            <img src="{{ asset('images/datacore1.jpg') }}" class="d-block w-100" alt="Image 1">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('images/datacore2.jpg') }}" class="d-block w-100" alt="Image 2">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('images/datacore3.jpg') }}" class="d-block w-100" alt="Image 3">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('images/datacore1.jpg') }}" class="d-block w-100" alt="Image 4">
        </div>
        <div class="carousel-item">
            <img src="{{ asset('images/datacore2.jpg') }}" class="d-block w-100" alt="Image 5">
        </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
<div class="text-center">
    <h5 id="hoverName" class="navbar-brand text-center">Data-Core</h5>
</div>

</main>
@include('layouts.footer')