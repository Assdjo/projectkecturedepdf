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
    <input class="bg-red-500 p-5 rounded ml-20" type="submit" value="Effacer l'article">
</form>
@endsection 