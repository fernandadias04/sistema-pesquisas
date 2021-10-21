<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Survey;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SurveyController extends Controller
{

    public function index(Request $request)
    {
        $query = Survey::query();
        $query->where('user_id', '=', auth()->id());

        if ($request->has('consulta'))
        {
            $query->where('name', 'like', '%'.str_replace(' ', '%', $request->get('consulta')).'%');
        }

        $query->orderBy('name', 'ASC');

        $surveys = $query->paginate(10);
        $surveys->appends($request->all());
        return view('index', compact('surveys'));
    }

    public function results(Request $request, Survey $survey)
    {

        if($survey->user_id != auth()->id())
        {
            abort(Response::HTTP_FORBIDDEN);
        }

        return view('results', compact('survey'));
    }

    public function create (Request $request)
    {

        return view('form');
    }

    public function store(Request $request)
    {
        $survey = Survey::create([
            'name'=>$request->get('name'),
            'user_id'=>auth()->id(),
        ]);

        $options = $request->get('optionsHide');
        foreach ($options as $option)
        {
            $op = Option::create([
                'name'=>$option,
                'survey_id'=>$survey->id,
            ]);
        }
        return redirect()->route('surveys');
    }

    public function edit($id)
    {
        $survey = Survey::findOrFail($id);

        if($survey->user_id != auth()->id())
        {
            abort(Response::HTTP_FORBIDDEN);
        }

        return view('form', compact('survey'));
    }


    public function update(Request $request, $id)
    {
        $survey = Survey::findOrFail($id);
        if($survey->user_id != auth()->id())
        {
            abort(Response::HTTP_FORBIDDEN);
        }

        $survey->update([
            'name'=> $request->get('name'),
        ]);

        $options = $request->get('options');

        $ids = collect($options)->pluck('id');

        foreach ($options as $option)
        {
            $op = Option::findOrFail($option['id']);
            $op->update([
                'name'=> $option['name'],
            ]);
        }

        /* Deleta linhas que foram apagadas*/
        $survey->options()->whereNotIn('id', $ids)->delete();


        $optionsHide = $request->get('optionsHide', []);
        foreach($optionsHide as $optionHide)
        {
            $opHide =  Option::create([
                'name'=>$optionHide,
                'survey_id'=>$survey->id,
            ]);
        }


        return redirect()->route('surveys');

    }

    public  function destroy(Request $request)
    {
        $survey = Survey::findOrFail($request->get('id'));
        $survey->delete();
        $request->session()->flash(
        'mensagem',
        "Enquete removida com sucesso"
        );

        return redirect()->route('surveys');


    }

}
