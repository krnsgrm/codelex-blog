<?php

namespace App\Controllers;

use App\Models\Article;
use App\Models\Comment;
use App\Services\ArticleServices\CreateArticleService;
use App\Services\ArticleServices\DeleteArticleService;
use App\Services\ArticleServices\ShowArticleService;

//use App\Services\ArticleServices\IndexArticleService;

class ArticlesController
{
    private array $articles;

    public function index()
    {
        $articlesQuery = query()
            ->select('*')
            ->from('articles')
            ->orderBy('created_at', 'desc')
            ->execute()
            ->fetchAllAssociative();

        $articles = [];

        foreach ($articlesQuery as $article) {
            $articles[] = new Article(
                (int)$article['id'],
                $article['title'],
                $article['content'],
                $article['created_at']
            );
        }

        return require_once __DIR__ . '/../Views/ArticlesIndexView.php';
    }

    public function show(array $vars)
    {
        $service = new ShowArticleService();
        $article = $service->execute((int)$vars['id']);

        $commentsQuery = query()
            ->select('*')
            ->from('comments')
            ->where('article_id = :articleId')
            ->setParameter('articleId', (int)$vars['id'])
            ->execute()
            ->fetchAllAssociative();

        $comments = [];

        foreach ($commentsQuery as $comment) {
            $comments[] = new Comment(
                $comment['id'],
                $comment['article_id'],
                $comment['name'],
                $comment['comment'],
                $comment['created_at']
            );
        }

        return require_once __DIR__ . '/../Views/ArticlesShowView.php';
    }

    public function delete(array $vars)
    {
        $service = new DeleteArticleService();
        $service->execute((int)$vars['id']);

        header('Location: /');
    }

    public function create()
    {
        $service = new CreateArticleService();
        $service->execute();

        header('Location: /articles');
    }

    public function getCreated()
    {
        return require_once __DIR__ . '/../Views/ArticlesCreateView.php';
    }
}