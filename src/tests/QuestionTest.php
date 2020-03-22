<?php

use App\Answer;
use App\Question;
use Laravel\Lumen\Testing\DatabaseMigrations;

class QuestionTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_get_questions()
    {
        factory(Question::class, 50)->create();

        $this->get('/questions');

        $this->assertResponseStatus(200);

        $this->seeJsonStructure([
            'data' => [
                [
                    'id',
                    'slug',
                    'question',
                    'rank',
                    'answers' => [],
                ],
            ],
        ]);
    }

    public function test_question_rank_sorting()
    {
        factory(Question::class, 50)->create();

        $this->get('/questions?sortBy=rank&sortDirection=ASC');

        $rank = Question::orderBy('rank', 'ASC')->first()->rank;

        // The normal way of getting the response content was unreliable.
        $json = $this->response->content();

        $this->assertStringContainsString("\"rank\":\"{$rank}\"", $json);

        // Sort it the other way now
        $this->get('/questions?sortBy=rank&sortDirection=DESC');

        $rank = Question::orderBy('rank', 'DESC')->first()->rank;

        $json = $this->response->content();

        $this->assertStringContainsString("\"rank\":\"{$rank}\"", $json);
    }

    public function test_question_creation()
    {
        $text = 'Is this a question?';

        $this->post('/questions', ['question' => $text])
            ->assertResponseStatus(201);

        $this->seeJsonContains(['question' => $text]);
    }

    public function test_question_validation_required()
    {
        $this->post('/questions', [])
            ->assertResponseStatus(422);

        $this->seeJsonContains(
            ['question' => ['The question field is required.']],
        );
    }

    public function test_question_validation_min()
    {
        $this->post('/questions', ['question' => 'a'])
            ->assertResponseStatus(422);

        $this->seeJsonContains(
            ['question' => ['The question must be at least 5 characters.']],
        );
    }

    public function test_question_validation_max()
    {
        $this->post('/questions', ['question' => str_repeat('this is 10', 301)])
            ->assertResponseStatus(422);

        $this->seeJsonContains(
            ['question' => ['The question may not be greater than 3000 characters.']],
        );
    }

    public function test_question_validation_string()
    {
        $this->post('/questions', ['question' => 10000])
            ->assertResponseStatus(422);

        $this->seeJsonContains(
            ['question' => ['The question must be a string.']],
        );
    }
}
