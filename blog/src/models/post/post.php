<?php

namespace App\Models\Post;

class Post
{
    private int $id;
    private string $title;
    private string $content;
    private string $frenchCreationDate;

    public function __construct($id, $title, $content, $frenchCreationDate)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->frenchCreationDate = $frenchCreationDate;
    }

    // Getters
    public function getId(): int
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getContent(): string
    {
        return $this->content;
    }

    public function getFrenchCreationDate(): string
    {
        return $this->frenchCreationDate;
    }
}
