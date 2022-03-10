<nav>
    <ul class="pagination mb-0">
        <li class="page-item {{ $pageNumber == 1 ? 'd-none' : '' }}"><a class="page-link"
                href="?pageNumber=1">&lt;&lt;</a></li>
        <li class="page-item {{ $pageNumber <= 1 ? 'disabled' : '' }}"><a class="page-link"
                href="?pageNumber={{ $pageNumber - 1 }}">&lt;</a></li>

        @foreach (range($pageNumber > 4 ? $pageNumber - 4 : 1, $pageNumber >= 4 && $pageNumber < $numberOfPages - 4 ? $pageNumber + 4 : ($numberOfPages > 4 && $pageNumber < $numberOfPages - 4 ? 4 : $numberOfPages)) as $page)
            <li class="page-item {{ $pageNumber == $page ? 'active' : '' }}"><a class="page-link"
                    href="?pageNumber={{ $page }}">{{ $page }}</a></li>
        @endforeach
        @if ($numberOfPages > 4 && $pageNumber < $numberOfPages - 4)
            <li class="page-item" id="goToPageButton{{ $position }}">
                <button class="page-link rounded-0 p-relative">...</button>
                <div class="goToPageContainer{{ $position }} p-3 shadow-sm">
                    <p class="mb-2">Go to page</p>
                    <input type="number" class="form-control mb-2 goToPageInput{{$position}}" step="1" min="1" max="{{$numberOfPages}}"/>
                    <button class="btn btn-primary w-100" id="goToPageSubmitButton{{$position}}">Go</button>
                </div>
            </li>
            <li class="page-item {{ $pageNumber == $numberOfPages ? 'active' : '' }}"><a class="page-link"
                    href="?pageNumber={{ $numberOfPages }}">{{ $numberOfPages }}</a></li>
        @endif


        <li class="page-item {{ $pageNumber >= $numberOfPages ? 'disabled' : '' }}"><a class="page-link"
                href="?pageNumber={{ $pageNumber + 1 }}">&gt;</a></li>
        <li class="page-item {{ $pageNumber == $numberOfPages ? 'd-none' : '' }}"><a class="page-link"
                href="?pageNumber={{ $numberOfPages }}">&gt;&gt;</a></li>
    </ul>
</nav>


@push('scripts')
    <script src='/js/pagination.js'></script>
@endpush
