@extends('layouts.Master')
@section("title")
formulaire d'ajout d'article
@endsection
@section('content')

<form action="{{route('create')}}" method="POST" enctype="multipart/form-data">
    @csrf
    @include('partials.article-form')
</form>

@endsection