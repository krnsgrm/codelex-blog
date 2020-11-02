<?php

namespace App\Controllers;

class CommentsController
{
    public function store(array $vars)
    {
        $articleId = (int)$vars['id'];

        query()
            ->insert('comments')
            ->setValue('article_id', '?')
            ->setValue('name', '?')
            ->setValue('comment', '?')
            ->setParameter(0, $articleId)
            ->setParameter(1, $_POST['name'])
            ->setParameter(2, $_POST['comment'])
            ->execute();

        header('Location: /articles/' . $articleId);
    }

    public function delete(array $vars)
    {
        $articleId = (int)$vars['id'];

        query()
            ->delete('comments')
            ->where('id = :comment_id')
            ->setParameter('comment_id', (int)$vars['comment_id'])
            ->execute();


        header('Location: /articles/' . $articleId);
    }
}