<?php

namespace Tests\Feature;

use App\Http\Livewire\IdeaIndex;
use App\Models\Category;
use App\Models\Idea;
use App\Models\Status;
use App\Models\User;
use App\Models\Vote;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class VoteIndexPageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function index_page_contains_idea_index_livewire_component()
    {
        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'Category 1']);

        $statusOpen = Status::factory()->create(['name' => 'Open']);


        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My First Idea',
            'category_id' => $categoryOne->id,
            'status_id' => $statusOpen->id,
            'description' => 'Description of my first idea'
        ]);

        $this->get(route('idea.index', $idea))
            ->assertSeeLivewire('idea-index');
    }

    /** @test */
    public function index_page_correctly_receives_votes_count()
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();


        $categoryOne = Category::factory()->create(['name' => 'Category 1']);

        $statusOpen = Status::factory()->create(['name' => 'Open']);


        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My First Idea',
            'category_id' => $categoryOne->id,
            'status_id' => $statusOpen->id,
            'description' => 'Description of my first idea'
        ]);

        Vote::factory()->create([
            'idea_id' => $idea->id,
            'user_id' => $user->id
        ]);

        Vote::factory()->create([
            'idea_id' => $idea->id,
            'user_id' => $userB->id
        ]);


        $this->get(route('idea.index'))
            ->assertViewHas('ideas', function ($ideas) {
                return (int) $ideas->first()->votes_count === 2;
            });
    }

    /** @test */
    public function votes_count_shows_correctly_on_index_page_livewire_component()
    {
        $user = User::factory()->create();


        $categoryOne = Category::factory()->create(['name' => 'Category 1']);

        $statusOpen = Status::factory()->create(['name' => 'Open']);


        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My First Idea',
            'category_id' => $categoryOne->id,
            'status_id' => $statusOpen->id,
            'description' => 'Description of my first idea'
        ]);

        Livewire::test(IdeaIndex::class, [
            'idea' => $idea,
            'votesCount' => 5
        ])
        ->assertSet('votesCount', 5)
        ->assertSeeHtml('<div class="font-semibold text-2xl">5</div>')
        ->assertSeeHtml('<div class="text-sm font-bold leading-none">5</div>');
    }
}
