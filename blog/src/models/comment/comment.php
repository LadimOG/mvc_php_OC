<?php

namespace App\Models\Comment;

class Comment
{
    public int $id;
    public string $author;
    public string $comment;
    public string $frenchCreationDate;
    public int $post_id;
}
