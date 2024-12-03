@extends('layouts.Master')
@section("title")
formulaire d'ajout d'article
@endsection
@section('content')

<form action="{{route('search')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('partials.search-input')
   
</form>

@endsection