@if ($paginator->hasPages())
<nav class="d-flex justify-content-center my-4" id="pagination">
    <ul class="pagination pagination-sm custom-pagination mb-0">

        {{-- First --}}
        <li class="page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
            <a class="page-link border-0 bg-transparent" href="{{ $paginator->url(1) }}">
                <h5>First</h5>
            </a>
        </li>

        {{-- Previous --}}
        <li class="page-item {{ $paginator->onFirstPage() ? 'disabled' : '' }}">
            <a class="page-link border-0 bg-transparent" href="{{ $paginator->previousPageUrl() }}">
                <h5>Previous</h5>
            </a>
        </li>

        {{-- Page Numbers --}}
        @php
            $totalPages = $paginator->lastPage();
            $currentPage = $paginator->currentPage();
            $range = 2; // how many pages to show around current
        @endphp

        @if ($totalPages <= 7)
            @for ($page = 1; $page <= $totalPages; $page++)
                <li class="page-item {{ $page == $currentPage ? 'active' : '' }}">
                    <a class="page-link rounded-circle" href="{{ $paginator->url($page) }}">{{ $page }}</a>
                </li>
            @endfor
        @else
            {{-- Show first page --}}
            <li class="page-item {{ 1 == $currentPage ? 'active' : '' }}">
                <a class="page-link rounded-circle" href="{{ $paginator->url(1) }}">1</a>
            </li>

            {{-- Dots if needed --}}
            @if ($currentPage > $range + 2)
                <li class="page-item disabled"><span class="page-link border-0 bg-transparent">...</span></li>
            @endif

            {{-- Middle pages --}}
            @for ($i = max(2, $currentPage - $range); $i <= min($totalPages - 1, $currentPage + $range); $i++)
                <li class="page-item {{ $i == $currentPage ? 'active' : '' }}">
                    <a class="page-link rounded-circle" href="{{ $paginator->url($i) }}">{{ $i }}</a>
                </li>
            @endfor

            {{-- Dots again if needed --}}
            @if ($currentPage < $totalPages - ($range + 1))
                <li class="page-item disabled"><span class="page-link border-0 bg-transparent">...</span></li>
            @endif

            {{-- Last page --}}
            <li class="page-item {{ $totalPages == $currentPage ? 'active' : '' }}">
                <a class="page-link rounded-circle" href="{{ $paginator->url($totalPages) }}">{{ $totalPages }}</a>
            </li>
        @endif

        {{-- Next --}}
        <li class="page-item {{ !$paginator->hasMorePages() ? 'disabled' : '' }}">
            <a class="page-link border-0 bg-transparent" href="{{ $paginator->nextPageUrl() }}">
                <h5>Next</h5>
            </a>
        </li>

        {{-- Last --}}
        <li class="page-item {{ !$paginator->hasMorePages() ? 'disabled' : '' }}">
            <a class="page-link border-0 bg-transparent" href="{{ $paginator->url($totalPages) }}">
                <h5>Last</h5>
            </a>
        </li>

    </ul>
</nav>
@endif
