<?php

class HomeController
{
    public function home()
    {
        return view('home');
    }

    public function about()
    {
        return view('about');
    }
}