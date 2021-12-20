<?php namespace Acme\Cars\Components;

use Cms\Classes\ComponentBase;
use Acme\Cars\Models\Category;

class CategoryList extends ComponentBase
{
    public $categories;

    public function componentDetails()
    {
        return [
            'name'          => 'Показать категории',
            'description'   => 'Показать категории'
        ];
    }

    function prepareVars()
    {
        $this->categories = Category::all();
    }

    public function onRun()
    {
        $this->prepareVars();
    }
}