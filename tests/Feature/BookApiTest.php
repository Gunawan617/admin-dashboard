<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;
use App\Models\User;
use App\Models\Book;

class BookApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_create_book()
    {
        Storage::fake('public');
        $user = User::factory()->create();
        $file = UploadedFile::fake()->image('cover.jpg');
        $payload = [
            'title' => 'Test Book',
            'author' => 'Test Author',
            'category' => 'Test Category',
            'excerpt' => 'Test Excerpt',
            'description' => 'Test Description',
            'price' => '100000',
            'cover_image' => $file,
        ];
        $response = $this->actingAs($user)->postJson('/api/admin/books', $payload);
        $response->assertStatus(201)
            ->assertJsonFragment(['title' => 'Test Book']);
        Storage::disk('public')->assertExists('books/' . $file->hashName());
    }

    public function test_authenticated_user_can_get_books()
    {
        $user = User::factory()->create();
        Book::factory()->count(2)->create();
        $response = $this->actingAs($user)->getJson('/api/admin/books');
        $response->assertStatus(200)
            ->assertJsonCount(2);
    }

    public function test_authenticated_user_can_update_book()
    {
        Storage::fake('public');
        $user = User::factory()->create();
        $book = Book::factory()->create();
        $file = UploadedFile::fake()->image('newcover.jpg');
        $payload = [
            'title' => 'Updated Title',
            'cover_image' => $file,
        ];
        $response = $this->actingAs($user)->putJson('/api/admin/books/' . $book->id, $payload);
        $response->assertStatus(200)
            ->assertJsonFragment(['title' => 'Updated Title']);
        Storage::disk('public')->assertExists('books/' . $file->hashName());
    }

    public function test_authenticated_user_can_delete_book()
    {
        Storage::fake('public');
        $user = User::factory()->create();
        $book = Book::factory()->create();
        $response = $this->actingAs($user)->deleteJson('/api/admin/books/' . $book->id);
        $response->assertStatus(200)
            ->assertJsonFragment(['message' => 'Book deleted successfully.']);
        $this->assertDatabaseMissing('books', ['id' => $book->id]);
    }
}
