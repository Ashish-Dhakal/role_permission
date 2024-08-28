<?php

namespace App\Http\Controllers;

use App\Models\Articale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ArticaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data['articles'] = Articale::all();
        return view('articles.list', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('articles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3',
            'text' => 'required|min:5',
            'auther' => 'required|min:4'
        ]);

        if ($validator->passes()) {
            $articale = new Articale();
            $articale->title = $request->title;
            $articale->text = $request->text;
            $articale->auther = $request->auther;
            $articale->save();
            return redirect()->route('articles.index')->with('success', 'Article created successfully');
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Articale $articale)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Articale $articale, $id)
    {
        $data['article'] = Articale::findorFail($id);
        return view('articles.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Articale $articale, $id)
    {
        $articale = Articale::findorFail($id);

        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3',
            'text' => 'required|min:5',
            'auther' => 'required|min:4'
        ]);
        if ($validator->passes()) {
            $articale->title = $request->title;
            $articale->text = $request->text;
            $articale->auther = $request->auther;
            $articale->save();
            return redirect()->route('articles.index')->with('success', 'Article updated successfully');
        } else {
            return redirect()->back()->withErrors($validator)->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( Request $request ,  Articale $articale)
    {
        $role = Articale::findorFail($request->id);
        $role->delete();
        return redirect()->route('articles.index')->with('success', 'Article Deleted Successfully!');
    }
}
