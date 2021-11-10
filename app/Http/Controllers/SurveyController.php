<?php

namespace App\Http\Controllers;

use App\Models\Option;
use App\Models\Survey;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Whoops\Run;

class SurveyController extends Controller
{

    public function index(Request $request)
    {
        $query = Survey::query();
        $query->where('user_id', '=', auth()->id());

        if ($request->has('search'))
        {
            $query->where('name', 'like', '%'.str_replace(' ', '%', $request->get('search')).'%');
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

        $options = $request->get('optionsHide');

        $tamOp = count($options);

        if ($tamOp < 2  )
        {
            return redirect()->route('surveys.create')->with('message', 'Enquete deve ter no míninmo duas opções');
        }

        $survey = Survey::create([
            'name'=>$request->get('name'),
            'user_id'=>auth()->id(),
        ]);

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

    public function share(Request $request, Survey $survey)
    {
        return view('vote', compact('survey'));
    }

    public function vote(Request $request, Survey $survey)
    {
        $id = $request->get('vote');
        $option = Option::find($id);
        $option->increment('votes');

        return redirect()->route('survey.share', compact('survey'))->with('mensagem', 'Voto computado com sucesso!');
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
