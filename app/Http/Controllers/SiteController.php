<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Form;
use App\Models\Lead;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function home()
    {
        return view('home');
    }

    public function viewForms()
    {
        $id = Auth::user()->getAuthIdentifier();
        $forms = Form::query()->where('user_id', $id)->paginate(2);
        return view('viewForms', ['forms' => $forms]);
    }

    public function viewLeads()
    {
        $id = Auth::user()->getAuthIdentifier();
        $forms = Form::query()->where('user_id', $id)->paginate(2);
        return view('viewLeads' ,['forms' => $forms]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('createForm');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */

    public function store(Request $request)
    {
        $questionsData = $request->get('questions');
        DB::beginTransaction();
        $id = Auth::user()->getAuthIdentifier();
        try {
            $form = new Form([
                'name' => $request->get('name'),
                'user_id' => $id
            ]);
            $form->save();
            foreach ($questionsData as $questionItem) {
                if (!isset($questionItem['name'])) {
                    continue;
                }
                //$answersData = $questionItem['answers'];
                /**
                 * @var Question $question
                 */
                $question = $form
                    ->questions()
                    ->create(
                        [
                            'question' => $questionItem['name'],
                        ]
                    );
                }
                $question->save();
//                $preparedAnswerData = array_map(function ($value) {
//                    return ['answer' => $value['answer']];
//                }, $answersData);
//                if (count($preparedAnswerData)) {
//                    $question->answers()->createMany($preparedAnswerData);
//                }
            DB::commit();
        } catch (\Throwable $e) {
            DB::rollBack();
            throw $e;
        }
        return redirect(Route('create'))->with('success', 'Форма создана');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $form = Form::with(['questions.answers'])->find($id);
        return view('viewForm', ['form' => $form]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $form = Form::with(['questions.answers'])->find($id);
        return view('editForm', ['form' => $form]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $form = Form::with(['questions.answers'])->find($id);
        $request->validate([
            'name' => 'required',
        ]);
        $form::find($id)->update(['name' => $request->get('name')]);
        $questions = $form->questions;
        foreach ($questions as $question) {
            $questionId = $question['id'];
            $request->validate([
                'questions-'.$questionId => 'required',
            ]);
            Question::find($questionId)->update(['question' => $request->get('questions-' . $questionId)]);
//            $answers = $question->answers;
//            foreach ($answers as $answer)
//            {
//                $answerId = $answer['id'];
//                $request->validate([
//                    'answers-'.$answerId => 'required',
//                ]);
//                Answer::find($answerId)->update(['answer' => $request->get('answers-' . $answerId)]);
//            }
        }
        return redirect(Route('viewForms'))->with('success', 'Форма обновлёна!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $question = new Question();
        $question_id = $question::query()->with('answers')->where('form_id', $id)->get('id');
        foreach ($question_id as $item) {
            $questionFind = $question::findOrFail($item->id);
            $questionFind->answers()->delete();
            $questionFind->delete();
        }
        $form = Form::find($id);
        $form->delete();
        return redirect(Route('viewForms'))->with('success', 'Форма удалёна');
    }

    public function deleteLead($id){
        $answer = new Answer();
        $answer_id = $answer::query()->where('lead_id', $id)->get('id');
        foreach ($answer_id as $item){
            $answerFind = $answer::findOrFail($item->id);
            $answerFind->delete();
        }
        $lead = Lead::find($id);
        $lead->delete();
        return redirect(Route('viewLeads'))->with('success', 'Lead удалён');
    }
}
