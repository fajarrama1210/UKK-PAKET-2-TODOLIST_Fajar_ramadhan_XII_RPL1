@if ($paginator->hasPages())
    <div class="d-flex justify-content-end mt-3">
        <nav aria-label="Pagination">
            <ul class="pagination">
                {{-- Tombol Previous --}}
                @if ($paginator->onFirstPage())
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">Previous</a>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">Previous</a>
                    </li>
                @endif

                {{-- Nomor Halaman --}}
                @foreach ($paginator->links()->elements as $element)
                    {{-- Jika ada titik "..." --}}
                    @if (is_string($element))
                        <li class="page-item disabled">
                            <a class="page-link" href="#">{{ $element }}</a>
                        </li>
                    @endif

                    {{-- Jika adalah array dengan nomor halaman --}}
                    @if (is_array($element))
                        @foreach ($element as $page => $url)
                            @if ($page == $paginator->currentPage())
                                <li class="page-item active">
                                    <a class="page-link" href="#">{{ $page }}</a>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                </li>
                            @endif
                        @endforeach
                    @endif
                @endforeach

                {{-- Tombol Next --}}
                @if ($paginator->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">Next</a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <a class="page-link" href="#" aria-disabled="true">Next</a>
                    </li>
                @endif
            </ul>
        </nav>
    </div>
@endif
