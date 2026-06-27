<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\User;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ItemApiTest extends TestCase
{
    // WAJIB ADA: Ini yang bertugas membuat tabel otomatis di database testing memori
    use RefreshDatabase;

    protected $user;
    protected $admin;
    protected $category;

    protected function setUp(): void
    {
        parent::setUp();

        // Membuat data kategori awal untuk relasi item
        Category::factory()->create([
            "id" => 1, 
            "name" => "Electronics"
        ]);

        // Membuat user dengan role non-admin
        $this->user = User::factory()->create([
            "role" => "user"
        ]);

        // Membuat user dengan role admin
        $this->admin = User::factory()->create([
            "role" => "admin"
        ]);
    }

    /** @test */
    public function test_guest_cannot_access_items()
    {
        $this->getJson("/api/v1/items")
            ->assertStatus(401);
    }

    /** @test */
    public function test_user_can_list_items()
    {
        $token = $this->user->createToken("api-token")->plainTextToken;

        $this->withHeader("Authorization", "Bearer " . $token)
            ->getJson("/api/v1/items")
            ->assertStatus(200)
            ->assertJsonStructure([
                "success", 
                "data", 
                "message"
            ]);
    }

    /** @test */
    public function test_user_cannot_delete_item()
    {
        $token = $this->user->createToken("api-token")->plainTextToken;

        $this->deleteJson(
            "/api/v1/items/1",
            [],
            ["Authorization" => "Bearer " . $token]
        )->assertStatus(403);
    }

    /** @test */
    public function test_admin_can_delete_item()
    {
        // Membuat item baru sebelum dihapus
        $item = Item::factory()->create([
            "category_id" => 1
        ]);

        $token = $this->admin->createToken("api-token")->plainTextToken;

        $this->deleteJson(
            "/api/v1/items/{$item->id}",
            [],
            ["Authorization" => "Bearer " . $token]
        )->assertStatus(204);
    }
}