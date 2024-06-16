<?php

namespace Tests\Feature;

use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AdminUserTest extends TestCase
{
    use RefreshDatabase;
    /**
     * Admin User create,edit, destroy.
     */
    public function testAdminUserStore(): void
    {
        $response = $this->post(route('admin.user.store'),[
            'name' => 'Test',
            'password' => '12345678',
            'email' => 'test@mail.ru',
            'position' => 'dsadsa'
        ]);
        $response->assertRedirect('/admin/users');

        $this->assertDatabaseCount('users', 1);

        $this->assertDatabaseHas('users', ['name' => 'Test']);

    }

    public function testAdminSeeUserEdit(): void
    {
        $user = User::factory()->create();
        $response = $this->get(route('admin.user.edit', $user->id));

        $response->assertStatus(200);

        $response->assertSee($user->name);
    }

    public function testAdminUserUpdate(): void
    {
        User::factory()->create();
        $this->assertDatabaseCount('users', 1);
        $user = User::first();
        $response = $this->put(route('admin.user.update',$user->id),[
            'name' => 'tested'
        ]);
        $response->assertRedirect(route('admin.user.index'));
        $this->assertEquals('tested', User::first()->name);
    }

    public function testAdminUserStoreBadEmail(): void
    {
        $response = $this->post(route('admin.user.store'),[
            'name' => 'Test',
            'password' => '123456',
            'email' => 'test',
            'position' => 'dsaddfsafsa'
        ]);
        $response->assertStatus(302);

        $this->assertDatabaseCount('users', 0);
    }

    public function testAdminUserUpdateBadUdate(): void
    {
        User::factory()->create();
        $this->assertDatabaseCount('users', 1);
        $user = User::first();
        $response = $this->put(route('admin.user.update',$user->id),[
            'name' => 'tested',
            'email' => 'test'
        ]);
        $response->assertStatus(302);

        $this->assertEquals($user['name'], User::first()->name);

        $this->assertEquals($user['email'], User::first()->email);
    }

    public function testAdminUserDestroy(): void
    {
        User::factory()->create();

        $this->assertDatabaseCount('users', 1);

        $user = User::first();

        $response = $this->delete(route('admin.user.destroy', $user->id));

        $response->assertStatus(302);

        $this->assertCount(0, User::all());
    }
}
