<?php namespace Acme\Blog\Models;

use Model;

/**
 * Model
 */
class Category extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Sortable;
    use \October\Rain\Database\Traits\NestedTree;
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'acme_blog_categories';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'title' => 'required|min:3',
    ];

    public $belongsToMany = [
        'posts' => 'Acme\Blog\Models\Post'
    ];
}
