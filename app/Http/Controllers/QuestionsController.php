<?php

namespace App\Http\Controllers;

use App\Question;
use App\Http\Requests\Questions\CreateQuestionRequest;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth'])->except(['index','show']);

    }

    /**
     *
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $questions = Question::with('owner')->latest()->paginate(10);
        return view('questions.index',compact('questions'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // app('debugbar').disable();
        return view('questions.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateQuestionRequest $request)
    {
        auth()->user()->questions()->create([
            'title' => $request->title,
            'body' => $request->body,
        ]);

        session()->flash('Success','Question has been added successfully');
        return redirect(route('questions.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Question  $question
     * @return \Illuminate\Http\Response
     */
    public function show(Question $question)
    {
        //
        //
        $question->increment('views_count');
        return view('questions.show',compact('question'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Question $question
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function edit(Question $question)
    {
        //
        if ($this->authorize('update',$question)) {
            return view('questions.edit',compact("question"));
        }
        abort(430, 'Access Denied');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Question $question
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Auth\Access\AuthorizationException
     */
    public function update(Request $request, Question $question)
    {
        //
        if ($this->authorize('update',$question)) {
            $question->update([
                "title" => $request->title,
                "body" => $request->body,
            ]);

            session()->flash('success', 'Question has been Modified successfully');
            return redirect(route('questions.index'));
        }
        abort(430, 'Access Denied');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Question $question
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy(Question $question)
    {
        //
        if ($this->authorize('delete',$question))
        {
            $question->delete();

            session()->flash('success','Question has been deleted successfully');
            return redirect(route('questions.index'));
        }
        abort(430, 'Access Denied');

    }
}
