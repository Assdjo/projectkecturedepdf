<!-- Formulaire personnalisé pour la création d'un article -->
<div class="flex justify-center items-center w-full h-full">
    <div class="container mx-auto my-4 px-4 lg:px-20">

        <div class="w-full p-8 my-4 md:px-12 lg:w-9/12 lg:pl-20 lg:pr-40 mr-auto rounded-2xl shadow-2xl">
            <div class="flex">
                <h1 class="font-bold uppercase text-5xl">Create New Article</h1>
            </div>


            <div class="grid grid-cols-1 gap-5 md:grid-cols-2 mt-5">
                <!-- Titre -->
                <input
                    class="w-full bg-gray-100 text-gray-900 mt-2 p-3 rounded-lg focus:outline-none focus:shadow-outline"
                    type="text" name="title" placeholder="Title*" value="{{ old('title', $article->title) }}" />
                @error('title')
                    <div>{{$message}}</div>
                @enderror
                <!-- Image (upload) -->
                <div>
                    <label for="image">image :</label>
                    <input
                        class="w-full bg-gray-100 text-gray-900 mt-2 p-3 rounded-lg focus:outline-none focus:shadow-outline"
                        type="file" name="image" accept="image/*" />

                    @error('image')
                        <div>{{$message}}</div>
                    @enderror
                </div>



                <!-- Contenu (facultatif) -->
                <textarea
                    class="w-full h-32 bg-gray-100 text-gray-900 mt-2 p-3 rounded-lg focus:outline-none focus:shadow-outline"
                    name="content" placeholder="Content (Optional)">{{ old('content',$article->content) }}</textarea>
                @error('content')
                    <div>{{$message}}</div>
                @enderror
            </div>

            <div class="my-4">
                <!-- Fichier (upload) -->
                <input
                    class="w-full bg-gray-100 text-gray-900 mt-2 p-3 rounded-lg focus:outline-none focus:shadow-outline"
                    type="file" name="file" accept=".pdf" />
            </div>
            @error('file')
                <div>{{$message}}</div>
            @enderror
            <!-- User ID (hidden, assuming the user is logged in) -->
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}" /> 

            <div class="my-2 w-1/2 lg:w-1/4">
                <button type="submit"
                    class="uppercase text-sm font-bold tracking-wide bg-blue-900 text-gray-100 p-3 rounded-lg w-full focus:outline-none focus:shadow-outline">
                    Submit Article
                </button>
            </div>

        </div>


    </div>
</div>