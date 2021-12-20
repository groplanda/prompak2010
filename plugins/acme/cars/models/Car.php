<?php namespace Acme\Cars\Models;

use Model;

/**
 * Model
 */
class Car extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\SoftDelete;
    use \October\Rain\Database\Traits\Sortable;
    use \October\Rain\Database\Traits\Sluggable;

    protected $dates = ['deleted_at'];
    protected $slugs = ['slug' => 'title'];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'acme_cars_car';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'title' => 'required',
        'slug' => 'required',
        'gallery.*' => 'image|max:1000|dimensions:min_width=100,min_height=100'
    ];

    public $belongsToMany = [
        'category' => [
            'Acme\Cars\Models\Category',
            'table' => 'acme_cars_car_category',
        ],
    ];

    public $attachMany = [
        'gallery' => ['System\Models\File', 'delete' => true ]
    ];

    public function afterDelete() {
        foreach ($this->gallery as $image) {
            $image->delete();
        }
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', 1);
    }
}
