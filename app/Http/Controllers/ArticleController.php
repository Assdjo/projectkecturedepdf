<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\UploadFileTrait;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use SplFileInfo;

class ArticleController extends Controller
{
    use AuthorizesRequests;
    use UploadFileTrait;
    public function index()
    {
        
        $articles = Article::with('user')->get();
         return view("articles.articles", compact('articles'));
    }
    public function create()
    {
    $this->authorize('create', Article::class);

        return view("articles.Create");
    }
    public function store(Request $request)
{
    $this->authorize('create', Article::class);
   
    $validateData = $request->validate([
        'title' => 'required|string',
        'content' => 'nullable|string',
        'user_id' => 'required|numeric|exists:users,id',
        'file' => 'nullable|file|mimes:pdf|max:2048',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
    ]);
    // dd($validateData);
    
    $filePath = null;
    if ($request->hasFile('file')) {
        $filePath = $this->UploadFile($request->file('file'), 'public/Articles');
    }

    $imagePath = null;
    if ($request->hasFile('image')) {
        $imagePath = $this->UploadFile($request->file('image'), 'public/images');
    }

    // Création de l'article
    Article::create([
        'title' => $validateData['title'],
        'content' => $validateData['content'],
        'user_id' => $validateData['user_id'],
        'file_path' => $filePath,
        'image' => $imagePath,
    ]);

  
    return redirect()->route('articles')->with('success', 'Nouvel article créé avec succès !');
}

    public function upload()
    {
        return view("articles.upload");
    }
    public function StoreFile(Request $request)
    {
    $this->authorize('create', Article::class);

        $validateData = $request->validate([
            '_token' => 'required|string',
            'title' => 'required|string',
            'content' => 'nullable|string',
            'user_id' => 'required|numeric|exists:users,id',
            'file' => 'required|file|mimes:pdf|max:2048',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',

        ]);

        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $this->UploadFile($request->file('file'), 'public/Articles');
        }
    
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $this->UploadFile($request->file('image'), 'public/images');
        }
    
        // Création de l'article
        Article::create([
            'title' => $validateData['title'],
            'content' => $validateData['content'],
            'user_id' => $validateData['user_id'],
            'file_path' => $filePath,
            'image' => $imagePath,
        ]);
    
      
        return redirect()->route('articles')->with('success', 'Nouvel article créé avec succès !');

        
       
    }

    public function show($id) {
        $article = Article::findOrFail($id);
        
        return view('articles.show', compact('article'));
    }
    public function edit(Article $article) {
        $this->authorize('update', $article);
        
        return view('articles.edit', compact('article'));
    }
    
    public function update(Request $request, Article $article){
        $this->authorize('update', $article);
        $filePath = null;
        if ($request->hasFile('file')) {
            $filePath = $this->UploadFile($request->file('file'), 'public/Articles');
        }
    
        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $this->UploadFile($request->file('image'), 'public/images');
        }
        $article->update($request->all());
        return redirect()->route('articles')->with('success', 'Nouvel article créé avec succès !');
    
    }
    
    public function destroy(Article $article) {
        $this->authorize('delete', $article);
        $article->delete();
        return redirect()->route('articles')->with('success', 'Nouvel article créé avec succès !');
    }


}
