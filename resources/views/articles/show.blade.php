
@extends('layouts.Master')

@section('content')
<div class=" flex justify-center m-5 rounded-lg">
<div class=" text-center w-10/12 p-5 shadow-2xl rounded-lg">
<p>titre : {{ $article->title }}</p>
<p>details : {{!empty($article->content)?$article->content:"ce fichier est un contenue PDF" }}</p>
<embed class="m-auto" src="{{ asset('storage/' . $article->file_path) }}" type="application/pdf" width="80%" height="500px">
<div class="my-10">
<a  href="/articles/{{ $article->id }}/edit">Éditer l'article</a>
</div>
</div>
</div>
@endsection


