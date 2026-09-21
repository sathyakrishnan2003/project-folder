<?php

class Post
{
    public $id;
    public $title;
    public $content;

    public function user()
    {
        return "Each blog post belongs to one user.";
    }
}