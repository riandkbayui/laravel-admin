@if ($paginator->hasPages())
    <nav>
        <ul class="pagination">
            {{-- Tombol "Previous" --}}
            @if ($paginator->onFirstPage())
                <li class="disabled"><a href="#"><span>&laquo;</span></a></li>
            @else
                <li><a href="{{ $paginator->previousPageUrl() }}" rel="prev">&laquo;</a></li>
            @endif

            {{-- Halaman Pertama --}}
            <li><a href="{{ $paginator->url(1) }}">1</a></li>

            {{-- Titik sebelum halaman aktif --}}
            @if ($paginator->currentPage() > 3)
                <li class="disabled"><span>...</span></li>
            @endif

            {{-- Halaman di sekitar halaman aktif --}}
            @php
                $start = max($paginator->currentPage() - 1, 2);
                $end = min($paginator->currentPage() + 1, $paginator->lastPage() - 1);
            @endphp

            @for ($i = $start; $i <= $end; $i++)
                @if ($i == $paginator->currentPage())
                    <li class="active"><span><a href="{{ $paginator->url($i) }}">{{ $i }}</a></span></li>
                @else
                    <li><a href="{{ $paginator->url($i) }}">{{ $i }}</a></li>
                @endif
            @endfor

            {{-- Titik setelah halaman aktif --}}
            @if ($paginator->currentPage() < $paginator->lastPage() - 2)
                <li class="disabled"><span>...</span></li>
            @endif

            {{-- Halaman Terakhir --}}
            @if ($paginator->lastPage() > 1)
                <li><a href="{{ $paginator->url($paginator->lastPage()) }}">{{ $paginator->lastPage() }}</a></li>
            @endif

            {{-- Tombol "Next" --}}
            @if ($paginator->hasMorePages())
                <li><a href="{{ $paginator->nextPageUrl() }}" rel="next">&raquo;</a></li>
            @else
                <li class="disabled"><a href="#"><span>&raquo;</span></a></li>
            @endif
        </ul>
    </nav>
@endif
