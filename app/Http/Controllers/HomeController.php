<?php

namespace App\Http\Controllers;

use App\Models\Answer;
use App\Models\Form;
use App\Models\Lead;
use App\Models\Question;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index(){
        $users = User::all();
        return view('index' ,['users' => $users]);
    }

    public function createLead(Request $request,$id)
    {
        $lead = new Lead([
            'form_id' => $id,
        ]);
        $lead->save();
        $lead = Lead::all();
        $lead_id = $lead->last();
        $questions = Question::query()->with('forms')->where('form_id', $id)->get();
        $a = $request->get('answer');
        $i = -1;
        foreach ($questions as $question)
        {
            $i++;
            $question_id = $question->id;
            $answer = new Answer([
                'answer' => $a[$i],
                'question_id' => $question_id,
                'lead_id' => $lead_id->id,
            ]);
            $answer->save();
        }
        return redirect(Route('index'))->with('success', 'Lead добавлен');
    }
}
