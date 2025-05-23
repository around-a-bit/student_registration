@include('layouts.adminHeader')
<!-- -------------------------------------------------------------------------------- -->


<style>
    main {
        display: block;
    }

    .card-body {
        padding: 0.5rem;
    }

    body {
        background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' version='1.1' xmlns:xlink='http://www.w3.org/1999/xlink' xmlns:svgjs='http://svgjs.dev/svgjs' width='1440' height='560' preserveAspectRatio='none' viewBox='0 0 1440 560'%3e%3cg mask='url(%26quot%3b%23SvgjsMask1073%26quot%3b)' fill='none'%3e%3crect width='1440' height='560' x='0' y='0' fill='rgba(173%2c 149%2c 183%2c 1)'%3e%3c/rect%3e%3cpath d='M0%2c532.274C97.839%2c535.924%2c169.328%2c442.51%2c242.785%2c377.781C306.599%2c321.549%2c367.597%2c261.184%2c397.853%2c181.693C426.99%2c105.143%2c406.093%2c23.059%2c408.956%2c-58.799C412.553%2c-161.653%2c471.013%2c-273.688%2c416.84%2c-361.194C362.845%2c-448.412%2c243.27%2c-465.07%2c143.276%2c-487.955C48.091%2c-509.739%2c-49.657%2c-515.671%2c-143.726%2c-489.484C-238.683%2c-463.05%2c-327.755%2c-414.415%2c-391.368%2c-339.122C-454.546%2c-264.344%2c-491.507%2c-169.19%2c-496.918%2c-71.446C-502.078%2c21.763%2c-469.696%2c112.654%2c-420.778%2c192.163C-375.656%2c265.503%2c-298.384%2c305.961%2c-231.416%2c360.091C-155.094%2c421.781%2c-98.068%2c528.616%2c0%2c532.274' fill='%23745781'%3e%3c/path%3e%3cpath d='M1440 1237.298C1565.665 1215.362 1600.7069999999999 1045.723 1704.46 971.5070000000001 1800.329 902.931 1965.261 929.3820000000001 2017.9 823.918 2070.2039999999997 719.124 1982.708 598.501 1946.173 487.223 1915.747 394.552 1882.836 305.204 1822.4470000000001 228.608 1759.761 149.098 1691.194 63.57400000000001 1592.9279999999999 39.176000000000045 1495.738 15.044999999999959 1403.818 84.09300000000002 1304.969 100.12700000000001 1187.533 119.17599999999999 1053.38 71.31700000000001 957.825 142.19299999999998 859.517 215.111 822.419 347.575 807.561 469.069 792.885 589.079 821.412 709.655 875.186 817.942 927.795 923.8820000000001 1013.74 1004.988 1108.709 1075.499 1209.422 1150.275 1316.431 1258.868 1440 1237.298' fill='%23e3dae6'%3e%3c/path%3e%3c/g%3e%3cdefs%3e%3cmask id='SvgjsMask1073'%3e%3crect width='1440' height='560' fill='white'%3e%3c/rect%3e%3c/mask%3e%3c/defs%3e%3c/svg%3e");
    }

</style>

<main class="container-fluid p-4">

    <!-- -------------------------------------------------------------------------------------------------------------------------------------------- -->

    <h2 class="mb-4 neon-heading fs-md-3 fs-sm-5"><i class="bi bi-funnel"></i> Filter</h2>
    <div class="container-fluid">
        <div class="table-responsive">
            <div class="card-body">
                <form action="{{ route('search-all-fees-head') }}" method="GET" id="search" class="d-flex flex-column">
                    <div class="searchAll">
                        <div class="row align-items-center mb-3">
                            <div class="col-12 col-md-6 d-flex align-items-center">
                                <label for="perPage" class="me-2 fw-bold text-dark mb-0">Show</label>
                                <select name="perPage" id="perPage" class="form-select form-select-sm w-auto me-2">
                                    <!-- <option value="1" {{ request('perPage') == 1 ? 'selected' : '' }}>1</option> -->
                                    <option value="5" {{ request('perPage') == 5 ? 'selected' : '' }}>5</option>
                                    <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                                    <option value="20" {{ request('perPage') == 20 ? 'selected' : '' }}>20</option>
                                </select>
                                <label for="perPage" class="fw-bold text-dark mb-0">entries</label>
                            </div>
                            <div class="col-12 col-md-6 text-end ">
                                <label for="search_term" class="form-label "><i class="bi bi-search"></i>Search fee by any details</label>
                                <input value="{{ old('search_term', session('search_term')) }}" class="form-control form-control-sm me-2" name="search_term" id="search_term" type="search" placeholder="Search..." aria-label="Search...">
                            </div>
                        </div>

                        <div class="accordion" id="accordionPanelsStayOpenExample">

                            <div class="row mt-4">
                                <div class="col-12 text-center">
                                    <button class="btn btn-outline-dark btn-sm" type="submit"><i class="bi bi-search"></i>Search</button>
                                    <a href="{{ route('admin.head.panel') }}" class="btn btn-outline-dark btn-sm">Reset All</a>
                                </div>
                            </div>

                        </div>
                </form>
            </div>
        </div>
    </div>
    <!-- -------------------------------------------------------------------------------------------------------------------------------------------- -->

    <div style="display: flex; justify-content: space-between; ">
        <span>
            <h2 class="mb-4 neon-heading fs-md-3 fs-sm-5">Fees Head Records <i class="bi bi-collection"></i></h2>
        </span>
    </div>






    <div class="accordion" id="accordionPanelsStayOpenExample">
        <form action="{{ route('admin.add.fees.head') }}" method="POST" class="form-control">
            @method('POST')
            @csrf
            <div class="accordion-item">
                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#panelsStayOpen-collapseOne" aria-expanded="false" aria-controls="panelsStayOpen-collapseOne">
                        Add New
                    </button>
                </h2>
                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse" aria-labelledby="panelsStayOpen-headingOne">
                    <div class="accordion-body">

                        <div class="row">
                            <div class="col">
                                <label for="name" class="form-label small text-muted">Name <span class="text-danger">*</span></label>
                                <input type="text" name="name" id="name" class="form-control">
                            </div>
                            <div class="col">
                                <label for="description" class="form-label small text-muted">description</label>
                                <input type="text" name="description" id="description" class="form-control">
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col-12 text-center">
                                <button class="btn btn-outline-dark btn-sm" id="validateFormFees" type="submit"><i class="bi bi-search"></i>Store</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </form>
    </div>

    @php
    $count = count($fees);
    @endphp
    <h5 style="color:#ffffff" class=" fs-md-3 fs-sm-5">Result fetched: {{$count}}</h5 style="color:#ffffff">
    <div id="table-responsive">
        <table class="table table-modern">
            <thead>
                <tr class="fs-md-3 fs-sm-5">
                    <th class="fixed-column">Action</th>
                    <th>SL No.</th>
                    <th>Fees Head</th>
                    <th>Description</th>
                </tr>
            </thead>
            <tbody>
                @if ($count === 0)
                <tr>
                    <td colspan="4" class="text-center">No data found</td>
                </tr>
                @else
                @foreach($fees as $fee)
                <tr class="fs-md-3 fs-sm-5">
                    <td class="fixed-column">
                        <a href="javascript:void(0);" class="btn btn-warning btn-sm edit-btn"
                            data-id="{{ $fee->id }}"
                            data-name="{{ $fee->name }}"
                            data-description="{{ $fee->description }}">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                      
                        @if(!($fee->deletable))
                        <form action="{{ route('admin.fees.head.delete',$fee->id) }}" id="admin-fees-head-delete-{{ $fee->id }}" method="POST" class="d-inline">
                            @csrf
                            @method('POST')
                            <button type="button" class="btn btn-danger btn-sm" onclick="alertMessage(event,'delete-feeHead','{{ $fee->id }}')"><i class="bi bi-trash3"></i>Delete</button>
                        </form>
                        @endif


                    </td>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $fee->name ?? 'No Data' }}</td>
                    <td>{{ $fee->description ?? 'No Data' }}</td>
                </tr>
                @endforeach
                @endif
            </tbody>
        </table>

        <div class="d-flex justify-content-center">
            {!! $fees->appends(['perPage' => request('perPage')])->links('pagination::bootstrap-5') !!}
        </div>
    </div>

</main>

<div class="modal fade" id="editFeesHeadModal" tabindex="-1" aria-labelledby="editFeesHeadLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered modal-dialog-scrollable"> <!-- <-- KEY FIX -->
        <form method="POST" id="editFeesHeadForm" class="needs-validation" novalidate>
            @csrf
            @method('POST')
            <div class="modal-content shadow-lg border-0 rounded-4">
                <div class="modal-header bg-primary text-white rounded-top-4">
                    <h5 class="modal-title fw-semibold" id="editFeesHeadLabel">
                        <i class="fas fa-pen-square me-2"></i> Edit Fees Head
                    </h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body px-4 py-3">
                    <input type="hidden" id="edit-id" name="id">

                    <div class="mb-3">
                        <label for="edit-name" class="form-label fw-medium">Fees Head Name</label>
                        <input type="text" name="name" id="edit-name" class="form-control form-control-lg" required>
                    </div>

                    <div class="mb-3">
                        <label for="edit-description" class="form-label fw-medium">Description</label>
                        <input type="text" name="description" id="edit-description" class="form-control form-control-lg" required>
                    </div>
                </div>
                <div class="modal-footer bg-light border-top-0 rounded-bottom-4 px-4 py-3">
                    <button type="submit" class="btn btn-success px-4">
                        <i class="fas fa-save me-1"></i> Update
                    </button>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                        Cancel
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>



<script>
    document.addEventListener('DOMContentLoaded', function() {
        const editButtons = document.querySelectorAll('.edit-btn');
        const editForm = document.getElementById('editFeesHeadForm');

        editButtons.forEach(button => {
            button.addEventListener('click', function() {
                const id = this.getAttribute('data-id');
                const name = this.getAttribute('data-name');
                const description = this.getAttribute('data-description');

                console.log("Editing ID:", id, "Name:", name, "Description:", description);

                // Now using correct input IDs
                document.getElementById('edit-id').value = id;
                document.getElementById('edit-name').value = name;
                document.getElementById('edit-description').value = description;

                editForm.action = `/adminFeesHeadUpdate/${id}`;

                const editModal = new bootstrap.Modal(document.getElementById('editFeesHeadModal'));
                editModal.show();
            });
        });
    });
</script>


<!-- -------------------------------------------------------------------------------------------------------------------------------------------- -->
<script>
    var csrfToken = "{{ csrf_token() }}";
</script>
<!-- ---------------------------------------------------------------------------------------------------------- -->



<!-- ---------------------------------------------------------------------------------------------------------- -->

<!-- <script src="{{ asset('js/script.js') }}"></script> -->

<!-- ---------------------------------------------------------------------------------------------------------- -->
@include('layouts.footer')