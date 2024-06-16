<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use phpDocumentor\Reflection\DocBlock\TagFactory;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserTest extends TestCase
{
    /**
     * Тестирование view c с формой страницы логина
     */
    use RefreshDatabase;

    public function test_login_index()
    {
        $response = $this->get('/login');
        $response->assertStatus(200);

    }

    /**
     * Тестирование action-авторизации проверки  логина и пароля
     */
    public function test_login_check()
    {
        $password = fake()->password(8);

        $user = User::factory(1)->create(['password' => Hash::make($password)]);

        $response = $this->post(route('check_login'), ['email' => $user[0]->email, 'password' => $password]);
        $response->assertRedirect(route('admin.index'));
    }

    /**
     * Тестирование view c с формой страницы регистрации
     */
    public function test_register_index()
    {
        $response = $this->get('/register');
        $response->assertStatus(200);

    }

    /**
     * Тестирование action-регистрации сохранение данных пользователя в базу
     */
    public function test_register()
    {
        $email    = fake()->email;
        $password = fake()->password(8);

        $response = $this->post(route('auth.register'), [
            'email'                 => $email,
            'password'              => $password,
            'password_confirmation' => $password
        ]);

        $this->assertDatabaseHas('users', ['email' => $email]);

        $response->assertSessionHas('success', function ($value) {
            return $value === trans('messages.register.successMessage');
        });
    }

    /**
     * Тестирование action-logout
     */
    public function test_logout()
    {
        $response = $this->get('/logout');
        $response->assertSessionHas('status', function ($value) {
            return $value === 200;
        });

    }

    /**
     * Тестирование Авторизирован ли пользователь, направляем на закрытый маршрут
     */
    public function test_autorize()
    {
        $password = 12345678;
        $hasPass  = Hash::make($password);
        $user     = User::factory(1)->create(
            [
                'email' => 'admin6@mail.ru', 'password' => $hasPass, 'id' => 1
            ]
        );
        $this->post(route('check_login'), ['email' => $user[0]->email, 'password' => $password]);
        $response = $this->get('/admin');
        $response->assertOk();

    }

}
