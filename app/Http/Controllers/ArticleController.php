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
        $redact =true;
        return view("articles.Create" , compact("redact"));
    }

    public function upload()
    {
        $upload =true;
        return view("articles.Create", compact("upload"));
    }  


public function store(Request $request)
{
    $this->authorize('create', Article::class);
   
    // dd(    $request->input('content'));
    $validateData = $request->validate([
        'title' => 'required|string',
        'description' => 'nullable|string',
        'content' => 'nullable|string',
        'user_id' => 'required|numeric|exists:users,id',
        'file' => 'nullable|file|mimes:pdf|max:2048',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
    ]);
    // dd($validateData);
    if (!isset($validateData['content'])) {
        $validateData['content'] = null;
    }
    
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
        'description' => $validateData['description'],
        'content' => $validateData['content'],
        'user_id' => $validateData['user_id'],
        'file_path' => $filePath,
        'image' => $imagePath,
    ]);

  
    return redirect()->route('articles')->with('success', 'Nouvel article créé avec succès !');
}
public function search(Request $request)
{
    $key = trim($request->get('search'));

    $articles = Article::query()
    ->where('title', 'like', "%{$key}%")
    ->orWhere('content', 'like', "%{$key}%")
    ->orderBy('created_at', 'desc')
    ->get();



$recent_posts = Article::query()
    ->orderBy('created_at', 'desc')
    ->take(5)
    ->get();

return view('articles.result-search', [
    'key' => $key,
    'articles' => $articles,
    'recent_posts' => $recent_posts
]);

  
    
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
       
        if (!empty($article['content'])) {
           
            $redact =true;
            return view('articles.edit', compact('article','redact'));
        } elseif(!empty($article['file_path'])) {
            $upload =true;
            $this->authorize('update', $article);
            return view('articles.edit', compact('article', 'upload'));
        } else {
            $redact =true;
            $upload =true;
            return view('articles.edit', compact('article', 'redact','upload'));
        }
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
        $article->update([
            'title' => $request->title,
            'description' => $request->description,
            'content' => $request->content,
            'user_id' => $request->user_id,
            'file_path' => $filePath,
            'image' => $imagePath,
    ]);
        return redirect()->route('articles')->with('success', 'Nouvel article créé avec succès !');
    
    }
    
    public function destroy(Article $article) {
        $this->authorize('delete', $article);
        $article->delete();
        return redirect()->route('articles')->with('success', 'Nouvel article créé avec succès !');
    }


}
