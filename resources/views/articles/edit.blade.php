@extends('layouts.Master')
@section("title")
formulaire d'ajout d'article
@endsection
@section('content')

<form action="/articles/{{$article->id}}/update" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    @include('partials.article-form')
   
</form>
<form action="/articles/{{ $article->id }}/delete" method="POST">
    @csrf
    @method('DELETE')
    <input type="submit" value="Effacer l'article">
</form>
@endsection 