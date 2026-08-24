<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminProfilePasswordTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_can_view_profile_and_password_page(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.profile.edit'));

        $response->assertStatus(200);
        $response->assertSee('Change Admin Password');
        $response->assertSee('Administrator Profile');
    }

    public function test_admin_can_successfully_change_password(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('OldPassword123!'),
        ]);

        $response = $this->actingAs($user)->put(route('admin.profile.password'), [
            'current_password' => 'OldPassword123!',
            'password' => 'NewSecurePassword2026!',
            'password_confirmation' => 'NewSecurePassword2026!',
        ]);

        $response->assertSessionHas('success');
        $user->refresh();
        $this->assertTrue(Hash::check('NewSecurePassword2026!', $user->password));
    }

    public function test_password_change_fails_with_incorrect_current_password(): void
    {
        $user = User::factory()->create([
            'password' => Hash::make('OldPassword123!'),
        ]);

        $response = $this->actingAs($user)->put(route('admin.profile.password'), [
            'current_password' => 'WrongCurrentPassword',
            'password' => 'NewSecurePassword2026!',
            'password_confirmation' => 'NewSecurePassword2026!',
        ]);

        $response->assertSessionHasErrors('current_password');
        $user->refresh();
        $this->assertTrue(Hash::check('OldPassword123!', $user->password));
    }

    public function test_admin_can_update_profile_name_and_email(): void
    {
        $user = User::factory()->create([
            'name' => 'Original Admin',
            'email' => 'admin@original.com',
        ]);

        $response = $this->actingAs($user)->put(route('admin.profile.update'), [
            'name' => 'Principal Partner Nnaji',
            'email' => 'partner@nnajioacompany.com',
        ]);

        $response->assertSessionHas('success');
        $user->refresh();
        $this->assertEquals('Principal Partner Nnaji', $user->name);
        $this->assertEquals('partner@nnajioacompany.com', $user->email);
    }
}
