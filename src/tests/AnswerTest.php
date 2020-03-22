<?php

use App\Answer;
use App\Question;
use Laravel\Lumen\Testing\DatabaseMigrations;

class AnswerTest extends TestCase
{
    use DatabaseMigrations;

    public function test_get_answers()
    {
        factory(Answer::class, 50)->create();

        $this->get('/answers');

        $this->assertResponseStatus(200);

        $this->seeJsonStructure([
            'data' => [
                [
                    'id',
                    'answer',
                    'question_id',
                    'tags' => [],
                ],
            ],
        ]);
    }

    public function test_answer_creation()
    {
        factory(Question::class)->create();
        $question = Question::first();
        $text = 'Is this a question or is it not?';
        $tags = 'tag1,tag2,tag3';

        $this->answer([
            'question_id' => $question->id,
            'answer' => $text,
            'tags' => $tags,
        ])->assertResponseStatus(201);

        $answer = Answer::first();

        $this->seeJsonContains([
            'answer' => $text,
            'tags' => explode(",", $tags), // Weird, but the documentation said to use a string and the JSON example showed an array
        ]);
    }

    public function test_answer_validation_required()
    {
        $this->answer([
            'question_id' => '',
            'answer' => '',
        ])->assertResponseStatus(422);

        $this->seeJsonEquals([
            'question_id' => ['The question id field is required.'],
            'answer' => ['The answer field is required.'],
        ]);
    }

    public function test_answer_validation_answer_min()
    {
        $this->answer([
            'answer' => 'a',
        ])->assertResponseStatus(422);

        $this->seeJsonContains([
            'answer' => ['The answer must be at least 5 characters.'],
        ]);
    }

    public function test_answer_validation_answer_max()
    {
        $this->answer([
            'answer' => str_repeat('this is 10', 301),
        ])->assertResponseStatus(422);

        $this->seeJsonContains([
            'answer' => ['The answer may not be greater than 3000 characters.'],
        ]);
    }

    public function test_answer_validation_answer_string()
    {
        $this->answer([
            'answer' => rand(1234812374, 1237419837241),
        ])->assertResponseStatus(422);

        $this->seeJsonContains([
            'answer' => ['The answer must be a string.'],
        ]);
    }


    public function test_answer_validation_tags_min()
    {
        $this->answer([
            'tags' => 'a',
        ])->assertResponseStatus(422);

        $this->seeJsonContains([
            'tags' => ['The tags must be at least 3 characters.'],
        ]);
    }

    public function test_answer_validation_tags_max()
    {
        $this->answer([
            'tags' => str_repeat('this is 10', 301),
        ])->assertResponseStatus(422);

        $this->seeJsonContains([
            'tags' => ['The tags may not be greater than 3000 characters.'],
        ]);
    }

    public function test_answer_validation_tags_string()
    {
        $this->answer([
            'tags' => rand(1234812374, 1237419837241),
        ])->assertResponseStatus(422);

        $this->seeJsonContains([
            'tags' => ['The tags must be a string.'],
        ]);
    }

    private function answer($mergeArray)
    {
        factory(Question::class, 1)->create();

        $array['question_id'] = Question::first()->id;
        $array['answer'] = 'Is this a answer?';
        $array['tags'] = 'tag1, tag2, tag3, this is also a tag';

        $mergedArray = array_merge($array, $mergeArray);

        return $this->post('/answers', [
            'question_id' => $mergedArray['question_id'],
            'answer' => $mergedArray['answer'],
            'tags' => $mergedArray['tags'],
        ]);
    }
}
