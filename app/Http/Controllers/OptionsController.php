<?php

namespace App\Http\Controllers;

use App\Models\Option;
use Illuminate\Http\Request;

class OptionsController extends Controller
{

    public  function destroy(Request $request, $suveryId)
    {
        $option = Option::findOrFail($request->id);
        $option->delete();

        return redirect()->route('', compact('suveryId'));
    }

}
