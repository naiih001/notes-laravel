<?php

namespace Tests\Unit;

use App\Models\Note;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NoteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that a note belongs to a user.
     */
    public function test_note_belongs_to_user(): void
    {
        $user = User::factory()->create();
        $note = Note::factory()->create(['user_id' => $user->id]);

        $this->assertTrue($note->user->is($user));
    }

    /**
     * Test that a note has title, content, and timestamps.
     */
    public function test_note_has_fillable_attributes(): void
    {
        $user = User::factory()->create();
        $data = [
            'title' => 'Test Title',
            'content' => 'Test Content',
            'user_id' => $user->id,
        ];

        $note = Note::create($data);

        $this->assertEquals('Test Title', $note->title);
        $this->assertEquals('Test Content', $note->content);
        $this->assertEquals($user->id, $note->user_id);
        $this->assertNotNull($note->created_at);
        $this->assertNotNull($note->updated_at);
    }
}
