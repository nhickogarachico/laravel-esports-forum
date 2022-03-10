<div class="position-relative">
    <div>
        <button class="btn btn-primary" id="sortMenuButton">SORT BY <i class="fas fa-caret-down"></i></button>
    </div>
    <div id="sortMenuContainer" class="shadow-sm">
        <ul class="nav flex-column">
            <li><a href="?sortby=latest&sortdirection=desc" class="py-2 px-4">Recent Comment</a></li>
            <li><a href="?sortby=title&sortdirection=asc" class="py-2 px-4">Title</a></li>
            <li><a href="?sortby=recent&sortdirection=desc" class="py-2 px-4">Latest Post</a></li>
            <li><a href="?sortby=recent&sortdirection=asc" class="py-2 px-4">Oldest Post</a></li>
            <li><a href="?sortby=likes&sortdirection=desc" class="py-2 px-4">Most Likes</a></li>
            <li><a href="?sortby=replies&sortdirection=desc" class="py-2 px-4">Most Replies</a></li>
        </ul>
    </div>
</div>

@push('scripts')
    <script src='/js/sort-menu.js'></script>
@endpush

@push('styles')
    <link rel="stylesheet" href="/css/sort-menu.css">
@endpush
