<?php

namespace App\Http\Controllers;

use App\Http\Requests\Answers\CreateAnswerRequest;
use App\Question;
use Illuminate\Http\Request;

class AnswersController extends Controller
{
    public function store (Question $question, CreateAnswerRequest $request){
        $question->answers()->create([
            "body"=>$request->body,
            'user_id'=>auth()->id()
        ]);
        session()->flash('success', 'your answer has been submitted successfully');
        return redirect($question->url);
    }
}
