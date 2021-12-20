<?php namespace Acme\Cars\Models;

use Model;

/**
 * Model
 */
class Category extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Sortable;
    use \October\Rain\Database\Traits\Sluggable;

    protected $slugs = ['slug' => 'title'];
    /*
     * Disable timestamps by default.
     * Remove this line if timestamps are defined in the database table.
     */
    public $timestamps = false;

    /**
     * @var string The database table used by the model.
     */
    public $table = 'acme_cars_category';

    public $belongsToMany = [
        'cars' => [
            'Acme\Cars\Models\Car',
            'table' => 'acme_cars_car_category'
        ]
    ];

    public $attachOne  = [
        'image' => ['System\Models\File', 'delete' => true ]
    ];

    /**
     * @var array Validation rules
     */
    public $rules = [
        'title' => 'required',
        'slug' => 'required',
        'image' => 'image|max:1000|dimensions:min_width=100,min_height=100'
    ];
}
