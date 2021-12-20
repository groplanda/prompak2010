<?php namespace Acme\Blog\Models;

use Model;

/**
 * Model
 */
class Comment extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Sortable;
    use \October\Rain\Database\Traits\NestedTree;
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'acme_blog_comments';

    /**
     * @var array Validation rules
     */
    public $rules = [
        'user_mail' => 'email',
    ];

    public $belongsTo = [
        'post' => 'Acme\Blog\Models\Post'
    ];

    public function scopeActive($query)
    {
        return $query->where('is_published', 1);
    }
}
