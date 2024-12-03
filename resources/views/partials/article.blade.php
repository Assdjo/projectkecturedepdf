
<div class="shadow-2xl rounded-lg  ">
    <img class="w-full rounded-t-lg" src="storage/{{$article->image}}" alt="">
    <div class="p-8">

        <p>{{ $article['title'] }}</p>
        <p>auteur de l'article : {{$article->user->name}}</p>
        <a href="/articles/{{ $article->id}}">
            <p class="font-bold">voir plus</p>
        </a>
    </div>
</div>