<div  class="bg-white rounded-lg flex flex-col shadow hover:shadow-2xl my-4 max-w-96">
    <!-- Article Image -->
    <a href="/articles/{{ $article->id }}" class="hover:opacity-75">
        <img class="rounded-t-lg" src="storage/{{$article->image}}" alt="">
    </a>
    <div class=" flex flex-col justify-start p-6">
        <a href="#" class="text-blue-700 text-sm font-bold uppercase pb-4">Category</a> <!-- Optionally replace Category with actual category -->
        <a href="/articles/{{ $article->id }}" class=" text-black text-3xl font-bold hover:text-blue-700 pb-4">{{ $article->title }}</a>
        <p class="text-sm pb-3">
            By <a href="#" class="text-black font-semibold hover:text-blue-700">{{ $article->user->name }}</a>, Published on {{ $article->created_at->format('F d, Y') }}
        </p>
        <p class="text-black pb-6">{{ Str::limit($article->description, 150) }}</p> <!-- Truncated content -->
        <a href="/articles/{{ $article->id }}" class="uppercase text-gray-800 hover:text-black">Continue Reading <i class="fas fa-arrow-right"></i></a>
    </div>
</div>