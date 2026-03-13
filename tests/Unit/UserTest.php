<?php

namespace Tests\Unit;

use App\Models\Note;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class UserTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that a user has many notes.
     */
    public function test_user_has_many_notes(): void
    {
        $user = User::factory()->create();
        $notes = Note::factory(3)->create(['user_id' => $user->id]);

        $this->assertCount(3, $user->notes);
        $user->notes->each(fn($note) => $this->assertTrue($note->user->is($user)));
    }

    /**
     * Test that a user has name, email, and password.
     */
    public function test_user_has_fillable_attributes(): void
    {
        $user = User::factory()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
        ]);

        $this->assertEquals('John Doe', $user->name);
        $this->assertEquals('john@example.com', $user->email);
        $this->assertNotNull($user->password);
    }

    /**
     * Test that password is hidden in serialization.
     */
    public function test_password_is_hidden(): void
    {
        $user = User::factory()->create();
        $array = $user->toArray();

        $this->assertArrayNotHasKey('password', $array);
    }
}
