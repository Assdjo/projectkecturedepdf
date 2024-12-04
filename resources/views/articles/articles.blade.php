@extends('layouts.master')

@section('title')
    les articles
@endsection

@section('content')
@if ($articles)
<h2 class="text-4xl font-bold mb-8">Articles :</h2>
        <div class="flex flex-wrap gap-10">
            @each('partials.article', $articles, 'article', 'partials.no-articles') 
        </div>
    @endif
@endsection
