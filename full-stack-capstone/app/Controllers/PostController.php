<?php

class PostController
{
    public function index()
    {
        return "Displaying all blog posts.";
    }

    public function create()
    {
        return "Create a new blog post.";
    }

    public function store()
    {
        return "Blog post saved successfully.";
    }

    public function show($id)
    {
        return "Displaying blog post ID: " . $id;
    }

    public function edit($id)
    {
        return "Editing blog post ID: " . $id;
    }

    public function update($id)
    {
        return "Blog post ID " . $id . " updated successfully.";
    }

    public function destroy($id)
    {
        return "Blog post ID " . $id . " deleted successfully.";
    }
}