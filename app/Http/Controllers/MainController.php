<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MainController extends Controller
{
    public function index()
    {
        $slides = Slider::all();
        return view('index')->with('slides', $slides);
    }

    public function policy()
    {
        return view('policy.privacy_policy');
    }

    public function send(Request $request)
    {
        if($request->isMethod('post')) {

            $validator = Validator::make($request->all(), Lead::rules(), Lead::messages(), Lead::attributeNames());

            if ($validator->passes()) {
                $lead = new Lead();
                $lead->fill($request->except('_token'))->save();

                return response()->json(['success' => $request->name . ', заявка отправлена. Ожидайте звонка нашего специалиста.']);
            }

            return response()->json(['error'=>$validator->errors()]);
        }
    }
}
