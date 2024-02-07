<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Document;

use App\Models\Case1;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DocumentTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_documents_list(): void
    {
        $documents = Document::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.documents.index'));

        $response->assertOk()->assertSee($documents[0]->caseID);
    }

    /**
     * @test
     */
    public function it_stores_the_document(): void
    {
        $data = Document::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.documents.store'), $data);

        $this->assertDatabaseHas('documents', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_document(): void
    {
        $document = Document::factory()->create();

        $case1 = Case1::factory()->create();

        $data = [
            'caseID' => $this->faker->text(255),
            'documentType' => $this->faker->text(),
            'dateFiled' => $this->faker->date(),
            'description' => $this->faker->sentence(15),
            'case1_id' => $case1->id,
        ];

        $response = $this->putJson(
            route('api.documents.update', $document),
            $data
        );

        $data['id'] = $document->id;

        $this->assertDatabaseHas('documents', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_document(): void
    {
        $document = Document::factory()->create();

        $response = $this->deleteJson(
            route('api.documents.destroy', $document)
        );

        $this->assertModelMissing($document);

        $response->assertNoContent();
    }
}
