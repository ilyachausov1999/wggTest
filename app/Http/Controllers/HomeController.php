<?php

namespace App\Http\Controllers;

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

    public function add(Request $request)
    {
        $lead = new Lead([
            'value' => $request->get('value'),
            'question_id' => $request->get('question_id')
        ]);
        $lead->save();
        return redirect(Route('index'))->with('success', 'Ответ добавлен');
    }
}
