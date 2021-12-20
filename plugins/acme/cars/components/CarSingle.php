<?php namespace Acme\Cars\Components;

use Cms\Classes\ComponentBase;
use Acme\Cars\Models\Car;

class CarSingle extends ComponentBase
{
    public $car;

    public function componentDetails()
    {
        return [
            'name'          => 'Показать товар',
            'description'   => 'Показать товар'
        ];
    }

    function prepareVars()
    {
        $slug = $this->param('slug');
        if($slug == null) {
            return \Response::make($this->controller->run('404'), 404);
        } else {
            $query = Car::where('slug', $slug)->first();
            if($query == null) {
                return \Response::make($this->controller->run('404'), 404);
            }
            $this->car = $query;
            $this->page->title =  $this->car->title;
            $this->page->meta_title =  $this->car->seo_title;
            $this->page->meta_description =  $this->car->seo_description;
        }
    }

    public function onRun()
    {
        $this->prepareVars();
    }
}
