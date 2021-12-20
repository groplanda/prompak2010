<?php namespace Acme\Gallery\Components;

use Cms\Classes\ComponentBase;
use Acme\Gallery\Models\Gallery;
use Response;

class Galleries extends ComponentBase
{
    public $gallery;

    public function componentDetails()
    {
        return [
            'name'          => 'Галерея',
            'description'   => 'Отображение галереи фотографий'
        ];
    }

    public function defineProperties()
    {
        return [
            'galleryName' => [
                'title'             => 'Выберите галерею',
                'type'              => 'dropdown',
                'default'           => 'us'
            ],
            'galleryType' => [
                'title'             => 'Внешний вид',
                'type'              => 'dropdown',
                'default'           => 'slider',
                'placeholder' => 'Выберите тип',
                'options'     => ['slider'=>'Слайдер', 'grid'=>'Обычный']
        
            ]
        ];
    }

    public function getGalleryNameOptions()
    {
        return Gallery::all()->lists('title', 'id');
    }

    public function onRun() 
    {
        $this->addCss('/plugins/acme/gallery/assets/css/jquery.fancybox.min.css');
        $this->addJs('/plugins/acme/gallery/assets/js/jquery.fancybox.min.js');
        $this->addJs('/plugins/acme/gallery/assets/js/gallery.js');

        $gallery = new Gallery;
        $this->gallery = $gallery -> where( 'id', '=', $this->property('galleryName') )->first();
        
    }

    public function onRender()
    {
        $view = $this->property('galleryType');
        if($view != 'slider') {
            return $this->renderPartial('@_grid.htm');
        }  
    }
    
}