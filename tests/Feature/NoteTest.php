<?php

use App\Models\Note;
use App\Models\Folder;

test('can list all notes', function () {
    $notes = Note::factory()->count(3)->create();

    $response = $this->get('/notes');

    $response->assertStatus(200);
    $response->assertJsonCount(3);
});

test('can create a note', function () {
    $folder = Folder::factory()->create();

    $noteData = [
        'folder_id' => $folder->id,
        'title' => 'Test Note',
        'text_body' => 'Test Content',
        'type' => 'text',
        'visibility' => 'private'
    ];

    $response = $this->post("/folders/{$folder->id}/notes", $noteData);

    $response->assertStatus(201);
    $response->assertJsonFragment(['title' => 'Test Note']);
});

test('can show single note', function () {
    $folder = Folder::factory()->create();
    $note = Note::factory()->create(['folder_id' => $folder->id]);

    $response = $this->get("/folders/{$folder->id}/notes/{$note->id}");

    $response->assertStatus(200);
    $response->assertJsonFragment(['id' => $note->id]);
});

test('can update note', function () {
    $folder = Folder::factory()->create();
    $note = Note::factory()->create(['folder_id' => $folder->id]);

    $response = $this->put("/folders/{$folder->id}/notes/{$note->id}", [
        'title' => 'Updated Title'
    ]);

    $response->assertStatus(200);
    $response->assertJsonFragment(['title' => 'Updated Title']);
});

test('can delete note', function () {
    $folder = Folder::factory()->create();
    $note = Note::factory()->create(['folder_id' => $folder->id]);

    $response = $this->delete("/folders/{$folder->id}/notes/{$note->id}");

    $response->assertStatus(204);
    $this->assertDatabaseMissing('notes', ['id' => $note->id]);
});
