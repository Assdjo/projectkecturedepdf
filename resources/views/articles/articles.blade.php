@extends('layouts.master')
@section('title')
les articles
@endsection
@section('content')
    <h2>Articles :</h2>
    @if ($articles)
        <div class="flex flex-wrap gap-10">
        @each('partials.article', $articles, 'article', 'partials.no-articles') 
        </div>
    @endif
@endsection