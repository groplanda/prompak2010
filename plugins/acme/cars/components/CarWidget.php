<?php namespace Acme\Cars\Components;

use Cms\Classes\ComponentBase;
use Acme\Cars\Models\Car;
use Acme\Cars\Models\Category;

class CarWidget extends ComponentBase
{
    public $cars;
    public $category;

    public function componentDetails()
    {
        return [
            'name'          => 'Блок товаров',
            'description'   => 'Добавить товары'
        ];
    }

    function prepareVars()
    {
        $slug = $this->param('slug');
        if($slug == null) {
            $this->cars = Car::active()->orderBy('sort_order', 'asc')->get();
        } else {
            $category = Category::where('slug', $slug)->first();
            if($category == null) {
                return \Response::make($this->controller->run('404'), 404);
            }
            $this->page->title = $category->title;
            $this->page->meta_title = $category->title;
            $this->cars = $category->cars()->active()->orderBy('sort_order', 'asc')->get();
            $this->category = $category;
        }
    }

    public function onRun()
    {
        $this->prepareVars();
    }
}
