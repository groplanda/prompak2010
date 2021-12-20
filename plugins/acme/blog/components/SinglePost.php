<?php namespace Acme\Blog\Components;

use Acme\Blog\Models\Post;
use Acme\Blog\Models\Comment;
use Response;

use Input;
use Validator;
use ValidationException;
use Flash;

class SinglePost extends \Cms\Classes\ComponentBase
{
    public function componentDetails()
    {
        return [
            'name' => 'Запись блока',
            'description' => 'Отображение записи'
        ];
    }

    public function defineProperties()
    {
        return [
            'showComments' => [
                'description' => 'Управление комментариями',
                'title' => 'Показать/Скрыть форму комментариев',
                'default' => false,
                'type' => 'checkbox',
                'options' => [false=>'Скрыть', true=>'Показать']
            ]
        ];
    }

    public function prepareVars()
    {
        $slug = $this->param('slug');

        $this->page['post'] = Post::where('slug', '=', $slug)->first();

        if($this->page['post'] == null) {
            return Response::make($this->controller->run('404'), 404);
        }

        $id = $this->page['post']->id;
        $this->page->title = $this->page['post']->title;
        $this->page->meta_title = $this->page['post']->seo_keywords;
        $this->page->meta_description  = $this->page['post']->seo_description;

        $this->page['showComments'] = $this->property('showComments');

        $this->page['categories'] = Post::find($id)->categories()->get();
        $this->page['comments'] = Post::find($id)->comments()->active()->orderBy('id')->get();
    
        

    }

    public function onRun()
    {

        $this->prepareVars();
    }

    public function onAddComment()
    {
        $rules = [
            'title_name'  => 'required|min:3',
            'user_mail' => 'email',
            'user_description'  => 'required|min:10|max:500',
            'post_id' => 'required|numeric'
        ];
    
        $messages = [
        'required' => 'Поле обязательно к заполнению!',
        'email'    => 'E-mail некорректный!',
        'min'      => 'Минимум :min символов!',
        'max'      => 'Не более :max символов!'
        ];

        $validator = Validator::make(Input::all(), $rules, $messages);
        //если не прошло валидацию
        if ($validator->fails()) {
    
          throw new ValidationException($validator);
        } else {
            $created = time();

            $comment = new Comment;
            $comment->title = Input::get('title_name');
            $comment->user_mail = Input::get('user_mail');
            $comment->description = Input::get('user_description');
            $comment->post_id = Input::get('post_id');
            $comment->created_at = $created;
            $comment->is_published = true;
            $comment->save();

            if($comment) {
                Flash::success('Комментарий успешно добавлен!');
            } else {
                Flash::error('Произошла ошибка!');
            }

        }
    }

}