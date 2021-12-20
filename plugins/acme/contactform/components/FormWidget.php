<?php namespace Acme\ContactForm\Components;

use Cms\Classes\ComponentBase;
use Input;
use Mail;
use Validator;
use ValidationException;
use Flash;
use Backend\Models\User;
use Db;

class FormWidget extends ComponentBase
{
  public function componentDetails()
  {
      return [
          'name' => 'Контактная форма',
          'description' => 'Простая контактная форма'
      ];
  }

  public function getUserMail() {

    return User::where('is_superuser', 1)->value('email');

  }

  public function onRun()
  {
    $this->addJs('/plugins/acme/contactform/assets/js/message.js');
  }

  public function onSend()
  {

    $rules = [
      'name'  => 'required|min:3|max:50',
      'phone' => 'required|min:5|max:20',
      'user_mail' => 'email'
    ];

    $messages = [
      'required' => 'Поле обязательно к заполнению!',
      'min'      => 'Минимум :min символов!',
      'max'      => 'Максимум :min символов!'
    ];

    $validator = Validator::make(Input::all(), $rules, $messages);
    //если не прошло валидацию
    if ($validator->fails()) {

      throw new ValidationException($validator);
    } else {
      //переменные
      $vars = [
        'name' => Input::get('name'),
        'phone' => Input::get('phone'),
        'user_mail' => Input::get('user_mail'),
        'user_product' => Input::get('product'),
      ];

      //вставка в базу данных
      $query = Db::table('acme_contactform_order')->insert([
        [
          'user_name' => Input::get('name'),
          'user_phone' => Input::get('phone'),
          'user_mail' => Input::get('user_mail'),
          'user_product' => Input::get('product'),
          'created_at' => time()
        ]
      ]);

      //отправка на почту
      Mail::send('acme.contactform::mail.message', $vars, function($message) {

          $message->to($this->getUserMail(), 'Admin Person');
          $message->subject('Сообщение с сайта');

      });

      if($query) {
        Flash::success('Сообщение успешно отправлено!');
      } else {
        Flash::error('Произошла ошибка!');
      }

    }

  }

}