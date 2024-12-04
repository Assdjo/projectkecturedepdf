@extends('layouts.Master')
@section('title')
resultat de recherche
@endsection
@section('content')

<h2 class="text-4xl mb-8">resultat pour : <span class="font-bold">{{$key}}</span></h2>
@if ($articles)
    <div class="flex flex-wrap gap-10">
        @each('partials.article', $articles, 'article', 'partials.no-articles')
    </div>
    <h3 class="font-bold text-2xl mt-7">Les articles récents : </h3>
    <div class="flex flex-wrap gap-10">
        @each('partials.article-recent', $recent_posts, 'article', 'partials.no-articles')
    </div>
@endif
@endsection