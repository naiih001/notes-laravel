<?php

namespace Tests\Feature;

use App\Models\Note;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class NoteTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test that authenticated user can view all their notes
     */
    public function test_user_can_view_all_notes(): void
    {
        $user = User::factory()->create();
        $notes = Note::factory(3)->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get(route('notes.index'));

        $response->assertStatus(200);
        foreach ($notes as $note) {
            $response->assertSee($note->title);
        }
    }

    /**
     * Test that user can view a single note
     */
    public function test_user_can_view_a_note(): void
    {
        $user = User::factory()->create();
        $note = Note::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->get(route('notes.show', $note));

        $response->assertStatus(200);
        $response->assertSee($note->title);
        $response->assertSee($note->content);
    }

    /**
     * Test that user cannot view another user's note
     */
    public function test_user_cannot_view_another_users_note(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $note = Note::factory()->create(['user_id' => $user1->id]);

        $response = $this->actingAs($user2)->get(route('notes.show', $note));

        $response->assertStatus(403);
    }

    /**
     * Test that user can create a note
     */
    public function test_user_can_create_a_note(): void
    {
        $user = User::factory()->create();
        $data = [
            'title' => 'Test Note',
            'content' => 'This is a test note',
        ];

        $response = $this->actingAs($user)->post(route('notes.store'), $data);

        $response->assertRedirect(route('notes.index'));
        $this->assertDatabaseHas('notes', [
            'title' => 'Test Note',
            'content' => 'This is a test note',
            'user_id' => $user->id,
        ]);
    }

    /**
     * Test that note creation requires title and content
     */
    public function test_note_creation_requires_title_and_content(): void
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->post(route('notes.store'), []);

        $response->assertSessionHasErrors(['title', 'content']);
    }

    /**
     * Test that user can update their own note
     */
    public function test_user_can_update_their_note(): void
    {
        $user = User::factory()->create();
        $note = Note::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->put(route('notes.update', $note), [
            'title' => 'Updated Title',
            'content' => 'Updated Content',
        ]);

        $response->assertRedirect(route('notes.show', $note));
        $this->assertDatabaseHas('notes', [
            'id' => $note->id,
            'title' => 'Updated Title',
            'content' => 'Updated Content',
        ]);
    }

    /**
     * Test that user cannot update another user's note
     */
    public function test_user_cannot_update_another_users_note(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $note = Note::factory()->create(['user_id' => $user1->id]);

        $response = $this->actingAs($user2)->put(route('notes.update', $note), [
            'title' => 'Hacked Title',
            'content' => 'Hacked Content',
        ]);

        $response->assertStatus(403);
        $this->assertDatabaseMissing('notes', ['title' => 'Hacked Title']);
    }

    /**
     * Test that user can delete their own note
     */
    public function test_user_can_delete_their_note(): void
    {
        $user = User::factory()->create();
        $note = Note::factory()->create(['user_id' => $user->id]);

        $response = $this->actingAs($user)->delete(route('notes.destroy', $note));

        $response->assertRedirect(route('notes.index'));
        $this->assertDatabaseMissing('notes', ['id' => $note->id]);
    }

    /**
     * Test that user cannot delete another user's note
     */
    public function test_user_cannot_delete_another_users_note(): void
    {
        $user1 = User::factory()->create();
        $user2 = User::factory()->create();
        $note = Note::factory()->create(['user_id' => $user1->id]);

        $response = $this->actingAs($user2)->delete(route('notes.destroy', $note));

        $response->assertStatus(403);
        $this->assertDatabaseHas('notes', ['id' => $note->id]);
    }

    /**
     * Test that guest is redirected away from protected routes
     */
    public function test_guest_is_redirected_from_notes_index(): void
    {
        $response = $this->get(route('notes.index'));

        $response->assertRedirect(route('login'));
    }

    /**
     * Test that guest is redirected from note show page
     */
    public function test_guest_is_redirected_from_notes_show(): void
    {
        $note = Note::factory()->create();

        $response = $this->get(route('notes.show', $note));

        $response->assertRedirect(route('login'));
    }

    /**
     * Test that guest can access landing page
     */
    public function test_guest_can_access_landing_page(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSee('Notezilla');
    }
}
