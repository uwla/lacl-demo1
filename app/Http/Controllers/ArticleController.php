<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Models\Article;
use Illuminate\Http\Response;

class ArticleController extends Controller
{
    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(Article::class, 'article');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): Response
    {
        return new Response(Article::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreArticleRequest $request): Response
    {
        $article = Article::create($request->all());
        return new Response($article);
    }

    /**
     * Display the specified resource.
     *
     * @param  App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function show(Article $article): Response
    {
        return new Response($article);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateArticleRequest $request, Article $article): Response
    {
        $article->update($request->all());
        return new Response($article);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  App\Models\Article  $article
     * @return \Illuminate\Http\Response
     */
    public function destroy(Article $article): Response
    {
        $article->delete();
        return new Response($article);
    }
}
