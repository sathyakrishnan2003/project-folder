<?php

class User
{
    public $id;
    public $name;
    public $email;

    public function posts()
    {
        return "A user can have many blog posts.";
    }
}