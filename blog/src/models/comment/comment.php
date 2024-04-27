<?php

namespace App\Models\Comment;

class Comment
{
    private  int $id;
    private  string $author;
    private  string $comment;
    private  string $frenchCreationDate;
    private  int $post_id;

    public function __construct($id, $author, $comment, $frenchCreationDate, $post_id)
    {
        $this->id = $id;
        $this->author = $author;
        $this->comment = $comment;
        $this->frenchCreationDate = $frenchCreationDate;
        $this->post_id = $post_id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getComment()
    {
        return $this->comment;
    }

    public function getFrenchCreationDate()
    {
        return $this->frenchCreationDate;
    }

    public function getPostId()
    {
        return $this->post_id;
    }
}
