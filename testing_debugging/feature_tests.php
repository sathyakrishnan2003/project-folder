<?php

// Feature Test Examples

function testHomepage()
{
    return "Homepage Loaded Successfully";
}

function testUserRegistration($username)
{
    if(!empty($username)){
        return "User Registration Passed";
    }
    return "Registration Failed";
}

function testLogin($email,$password)
{
    if($email=="admin@gmail.com" && $password=="123456"){
        return "Login Passed";
    }
    return "Login Failed";
}

function testCreatePost($title)
{
    return "Post '$title' Created Successfully";
}

function testDeletePost($title)
{
    return "Post '$title' Deleted Successfully";
}

echo testHomepage().PHP_EOL;
echo testUserRegistration("Sathya").PHP_EOL;
echo testLogin("admin@gmail.com","123456").PHP_EOL;
echo testCreatePost("Laravel Testing").PHP_EOL;
echo testDeletePost("Laravel Testing").PHP_EOL;

?>