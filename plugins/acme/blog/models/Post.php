<?php namespace Acme\Blog\Models;

use Model;
/**
 * Model
 */
class Post extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Sluggable;
    use \October\Rain\Database\Traits\SoftDelete;
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Sortable;
    use \October\Rain\Database\Traits\NestedTree;

    protected $dates = ['deleted_at'];

    /**
     * @var string The database table used by the model.
     */
    public $table = 'acme_blog_posts';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'title' => 'required|min:3',
    ];

    protected $slugs = ['slug' => 'title'];

    public $belongsToMany = [
        'categories' => [
            'Acme\Blog\Models\Category',
            'table'    => 'acme_blog_posts_categories'
        ]
    ];

    public $hasMany = [
        'comments' => 'Acme\Blog\Models\Comment',
        'key' => 'post_id'
    ];

    public static $allowedSortingOptions = [
        'title asc'       => 'Название (А-Я)',
        'title desc'      => 'Название (Я-А)',
        'created_at desc' => 'Вначале новые',
        'created_at asc'  => 'Вначале старые'
    ];

    public function scopeListFrontEnd($query, $options = [], $perPage)
    {

        extract(array_merge([
            'page'    => 1,
            'perPage' => $perPage,
            'categories' => null,
            'sort' => 'title asc'
        ], $options));

        if($categories !== null) {
            
            if(!is_array($categories)) {
                $categories = [$categories];
            } 

            foreach($categories as $category) {
                $query->whereHas('categories', function($q) use ($category){
                    $q->where('id', '=', $category);
                });
            }

        }

        if(!is_array($sort)) {
            $sort = [$sort];
        }

        foreach($sort as $_sort) {
            
            if(in_array($_sort, array_keys(self::$allowedSortingOptions))) {

                $parts = explode(' ', $_sort);

                if(count($parts) < 2) {
                    array_push($parts, 'desc');
                }

                list($sortField, $sortDirecton) = $parts;

                $query->orderBy($sortField, $sortDirecton);

            }

        }

        $lastPage = $query->paginate($perPage, $page)->lastPage();

        if($lastPage < $page){
            $page = 1;
        }

        return $query->paginate($perPage, $page);
    }

    public function scopeActive($query)
    {
        return $query->where('is_published', 1);
    }
}
