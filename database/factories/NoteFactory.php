<?php

namespace Database\Factories;

use App\Models\Folder;
use App\Models\Note;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Note>
 */
class NoteFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // possible note types
        $types = ['text', 'pdf'];
        $type = $this->faker->randomElement($types);

        // For demonstration, we’ll assign text_body or pdf_path depending on $type
        $textBody = null;
        $pdfPath = null;
        if ($type === 'text') {
            $textBody = $this->faker->paragraph();
        } else {
            // In reality, you'd store an actual PDF path or file
            // We'll just store a dummy string
            $pdfPath = 'storage/uploads/sample.pdf';
        }

        return [
            'folder_id' => Folder::factory(),
            'title' => $this->faker->sentence(4),
            'visibility' => $this->faker->randomElement(['shared', 'private']),
            'type' => $type,
            'text_body' => $textBody,
            'pdf_path' => $pdfPath,
        ];
    }
}
