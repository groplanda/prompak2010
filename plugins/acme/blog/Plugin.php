<?php namespace Acme\Blog;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            'Acme\Blog\Components\BlogPosts' => 'BlogPosts',
            'Acme\Blog\Components\SinglePost' => 'SinglePost'
        ];
    }

    public function registerSettings()
    {
    }

}
