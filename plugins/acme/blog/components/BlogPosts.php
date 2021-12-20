<?php namespace Acme\Blog\Components;

use Acme\Blog\Models\Post;
use Acme\Blog\Models\Category;

class BlogPosts extends \Cms\Classes\ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Список записей',
            'description' => 'Показать записи блога'
        ];
    }

    public function defineProperties()
    {
        return [
            'maxItems' => [
                'title'             => 'Записей на странице',
                'default'           => 5,
                'type'              => 'string',
                'validationPattern' => '^[0-9]+$',
                'validationMessage' => 'Можно использовать только цифры'
            ]
        ];
    }

    function prepareVars()
    {

        $options = post('filter', []);

        $perPage = $this->property('maxItems', 5);

        $this->page['posts'] = Post::active()->listFrontEnd($options, $perPage);
        $this->page['categories'] = Category::all();
        $this->page['sortOptions'] = Post::$allowedSortingOptions;
        $this->page['pages'] = $this->page['posts']->lastPage();
        $this->page['currentPage'] = $this->page['posts']->currentPage();

    }

    public function onRun()
    {
        // This code will be executed when the page or layout is
        // loaded and the component is attached to it.
        $this->addJs('/plugins/acme/blog/assets/js/blog-controls.js');
        $this->prepareVars();
      
    }

    public function onFilterPosts()
    {
        $this->prepareVars();
    }
}