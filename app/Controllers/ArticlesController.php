<?php

namespace App\Controllers;

use App\Models\Article;

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
        $articleQuery = query()
            ->select('*')
            ->from('articles')
            ->where('id = :id')
            ->setParameter('id', (int)$vars['id'])
            ->execute()
            ->fetchAssociative();

        $article = new Article(
            (int)$articleQuery['id'],
            $articleQuery['title'],
            $articleQuery['content'],
            $articleQuery['created_at'],
        );

        return require_once __DIR__ . '/../Views/ArticlesShowView.php';
    }

    public function delete(array $vars)
    {
        query()
            ->delete('articles')
            ->where('id = :id')
            ->setParameter('id', (int)$vars['id'])
            ->execute();

        header('Location: /');
    }

    public function create()
    {
        query()
            ->insert('articles')
            ->setValue('title', '?')
            ->setValue('content', '?')
            ->setParameter(0, $_POST['title'])
            ->setParameter(1, $_POST['content'])
            ->execute();

        header('Location: /articles');
    }

    public function getCreated()
    {
        return require_once __DIR__ . '/../Views/ArticlesCreateView.php';
    }
}