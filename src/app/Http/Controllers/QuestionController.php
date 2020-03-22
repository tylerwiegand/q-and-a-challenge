<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class QuestionController extends Controller
{
    /**
     * @group Questions
     * 
     * Request paginated list of Questions
     * 
     * @queryParam sortBy optional Sort by anything, only 'rank' currently supported.
     * @queryParam sortDirection optional Sort direction, ASC (default) or DESC.
     *
     * @response 200 {"current_page":1,"data":[{"id":1,"slug":"blanditiis_voluptate","question":"Blanditiis voluptate laudantium est minus accusantium. Mollitia et qui totam sit temporibus dolor omnis. Vel quia consequuntur sunt non?","rank":60,"answers":[]},{"id":2,"slug":"et_voluptas_est_libe","question":"Et voluptas est libero distinctio modi dolor. Voluptate corporis aut alias et. Eaque perspiciatis sunt incidunt ratione omnis et?","rank":10,"answers":[]},{"id":3,"slug":"ut_quaerat_voluptas","question":"Ut quaerat voluptas dicta ea nihil ut. Labore dolores mollitia omnis velit delectus. Tenetur assumenda ducimus suscipit dolor occaecati?","rank":18,"answers":[{"id":35,"question_id":3,"answer":"Quia quaerat dolorum aut molestiae qui quasi delectus. Molestiae repudiandae eligendi magni ratione repellat consectetur quaerat. Vero autem ex praesentium dolor sint modi.","tags":["rem"]}]},{"id":4,"slug":"illum_corporis_quasi","question":"Illum corporis quasi et animi omnis magni quia veritatis. Corporis repudiandae rerum rerum veniam. Explicabo perferendis dicta voluptatem numquam iste?","rank":45,"answers":[]},{"id":19,"slug":"tempore_velit_blandi","question":"Tempore velit blanditiis architecto consectetur voluptatem. Nemo consequuntur nihil reprehenderit id aliquid aliquid. Quia atque sit quod molestiae earum?","rank":35,"answers":[]},{"id":20,"slug":"et_nesciunt_modi_qui","question":"Et nesciunt modi quia error. Sed molestiae nemo corporis quam aut. Ratione maxime hic nihil?","rank":45,"answers":[{"id":28,"question_id":20,"answer":"Distinctio consectetur architecto quos at illum odit. Qui atque repellendus optio ut labore consequuntur eos omnis.","tags":["et","est","quidem","dicta","corrupti"]}]}],"first_page_url":"http:\/\/localhost:8080\/questions?page=1","from":1,"last_page":50,"last_page_url":"http:\/\/localhost:8080\/questions?page=50","next_page_url":"http:\/\/localhost:8080\/questions?page=2","path":"http:\/\/localhost:8080\/questions","per_page":20,"prev_page_url":null,"to":20,"total":1000}
     * 
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        // I'd probably normally reach for a package like realpage/json-api-for-lumen
        // or something, but I'm guessing you wanted a homebrewed solution
        $builder = Question::with('answers');

        if (in_array($sortBy = $request->query('sortBy'), Question::$sortable)) {
            in_array($sortDirection = $request->query('sortDirection'), Question::$sortDirections) ? $sortDirection : $sortDirection = 'ASC';
            $builder->orderBy($sortBy, $sortDirection);
        }

        return $builder->paginate(20);
    }

    /**
     * @group Questions
     * 
     * Create a Question and store it
     * 
     * @bodyParam question required Accepts a string greater than 5 but less than 3000 characters long.
     *
     * @response 201 {"question":"What is love?","rank":102,"slug":"what_is_love","id":1002}
     * 
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'question' => 'required|string|min:5|max:3000',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $question = Question::create([
            'question' => $request->question,
            'rank'     => (Question::orderBy('rank', 'DESC')->first()->rank ?? 0) + 1,
        ]);

        return response()->json($question, 201);
    }
}
