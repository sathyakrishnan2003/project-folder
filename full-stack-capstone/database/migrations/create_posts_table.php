<?php

class CreatePostsTable
{
    public function up()
    {
        echo "Creating posts table...";

        /*
        id
        title
        content
        user_id
        created_at
        updated_at
        */
    }

    public function down()
    {
        echo "Dropping posts table...";
    }
}