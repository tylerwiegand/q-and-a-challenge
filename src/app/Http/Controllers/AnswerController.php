<?php

namespace App\Http\Controllers;

use App\Answer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AnswerController extends Controller
{
    /**
     * @group Answers
     * 
     * Request paginated list of Answers
     *
     * @response 200 {"current_page":1,"data":[{"id":1,"question_id":411,"answer":"Nisi fugiat magnam adipisci eum aut doloremque.","tags":["nam","repellendus","quisquam","nemo"]},{"id":2,"question_id":651,"answer":"Facilis praesentium repellendus architecto optio in.","tags":["nam","maiores","eaque","aperiam"]},{"id":3,"question_id":306,"answer":"Est dolores cumque repellendus molestiae beatae ut a sit. Numquam aut velit similique laboriosam.","tags":["deleniti","ab","aliquid"]},{"id":4,"question_id":187,"answer":"Dolorem magnam debitis hic ut eos aliquid.","tags":["eos","debitis","velit"]},{"id":5,"question_id":91,"answer":"A eum enim neque consequuntur.","tags":["modi","quos"]}],"first_page_url":"http:\/\/localhost:8080\/answers?page=1","from":1,"last_page":5,"last_page_url":"http:\/\/localhost:8080\/answers?page=5","next_page_url":"http:\/\/localhost:8080\/answers?page=2","path":"http:\/\/localhost:8080\/answers","per_page":20,"prev_page_url":null,"to":20,"total":100}
     * 
     * @param Request $request
     * @return Response
     */
    public function index()
    {
        return Answer::paginate(20);
    }

    /**
     * @group Answers
     * 
     * Create an Answer and store it
     * 
     * @bodyParam question_id required Accepts only an existing ID (integer) in the questions table.
     * @bodyParam answer required Accepts a string greater than 5 but less than 3000 characters long.
     * @bodyParam tags optional Accepts a comma delimited string greater than 5 but less than 3000 characters long.
     * 
     * @response 201 {"question_id":"1","answer":"Love is food.","tags":["tempora","mushroom","beans"],"id":101}
     * 
     */

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question_id' => 'required|exists:questions,id',
            'answer'      => 'required|string|min:5|max:3000',
            'tags'        => 'string|min:3|max:3000',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $answer = Answer::create([
            'question_id' => $request->question_id,
            'answer'      => $request->answer,
            'tags'        => $request->tags,
        ]);

        return response()->json($answer, 201);
    }
}
