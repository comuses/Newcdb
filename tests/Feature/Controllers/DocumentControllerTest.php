<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Document;

use App\Models\Case1;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DocumentControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_documents(): void
    {
        $documents = Document::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('documents.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.documents.index')
            ->assertViewHas('documents');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_document(): void
    {
        $response = $this->get(route('documents.create'));

        $response->assertOk()->assertViewIs('app.documents.create');
    }

    /**
     * @test
     */
    public function it_stores_the_document(): void
    {
        $data = Document::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('documents.store'), $data);

        $this->assertDatabaseHas('documents', $data);

        $document = Document::latest('id')->first();

        $response->assertRedirect(route('documents.edit', $document));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_document(): void
    {
        $document = Document::factory()->create();

        $response = $this->get(route('documents.show', $document));

        $response
            ->assertOk()
            ->assertViewIs('app.documents.show')
            ->assertViewHas('document');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_document(): void
    {
        $document = Document::factory()->create();

        $response = $this->get(route('documents.edit', $document));

        $response
            ->assertOk()
            ->assertViewIs('app.documents.edit')
            ->assertViewHas('document');
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

        $response = $this->put(route('documents.update', $document), $data);

        $data['id'] = $document->id;

        $this->assertDatabaseHas('documents', $data);

        $response->assertRedirect(route('documents.edit', $document));
    }

    /**
     * @test
     */
    public function it_deletes_the_document(): void
    {
        $document = Document::factory()->create();

        $response = $this->delete(route('documents.destroy', $document));

        $response->assertRedirect(route('documents.index'));

        $this->assertModelMissing($document);
    }
}
