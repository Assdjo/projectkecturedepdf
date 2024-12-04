

<form class="flex" action="{{route('search')}}" method="GET" enctype="multipart/form-data">
    @csrf
    @include('partials.search-input')
</form>

