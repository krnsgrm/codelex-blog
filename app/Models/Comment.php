<?php

namespace App\Models;

class Comment
{
    private int $id;
    private int $articleId;
    private string $name;
    private string $comment;
    private string $createdAt;

    public function __construct(int $id, int $articleId, string $name, string $comment, string $createdAt)
    {
        $this->id = $id;
        $this->articleId = $articleId;
        $this->name = $name;
        $this->comment = $comment;
        $this->createdAt = $createdAt;

    }

    public function id(): int
    {
        return $this->id;
    }

    public function articleId(): int
    {
        return $this->articleId;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function comment(): string
    {
        return $this->comment;
    }

    public function createdAt(): string
    {
        return $this->createdAt;
    }
}