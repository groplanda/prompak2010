<?php namespace Acme\Blog\Controllers;

use Backend\Classes\Controller;
use BackendMenu;
use View;
use Response;
use Acme\Blog\Models\Post;

class PostsController extends Controller
{
    public $implement = [
        'Backend\Behaviors\ListController',
        'Backend\Behaviors\FormController',
        'Backend\Behaviors\ReorderController',
        'Backend.Behaviors.RelationController'
    ];
    
    public $listConfig = 'config_list.yaml';
    public $formConfig = 'config_form.yaml';
    public $reorderConfig = 'config_reorder.yaml';
    public $relationConfig = 'config_relation.yaml';

    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Acme.Blog', 'blog');
    }

}
