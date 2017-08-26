<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Booklist;
use App\Booktitle;


class BooklistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $buchlisten = Booklist::all();

        return view('booklists/index', compact('buchlisten'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $booklist = Booklist::findOrFail($id);
        $booktitlesAttached = $booklist->booktitles;

        $booktitlesNotAttached = Booktitle::all()->diff($booktitlesAttached);

        /*
        $booktitlesNotAttached = Booktitle::whereDoesntHave('booklists', function($query) use ($id) {
            $query->where('booklist_id', $id);
        })->get();
        */

        return view('booklists/show', compact('booklist', 'booktitlesAttached', 'booktitlesNotAttached'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function attach(Request $request, $id)
    {
        Booklist::find($id)->booktitles()->attach($request->bid);

        return redirect()->route('buchlisten.show', ['id' => $id]);
    }


    public function detach($booklist_id, $booktitle_id)
    {
        Booklist::find($booklist_id)->booktitles()->detach($booktitle_id);

        return redirect()->route('buchlisten.show', ['id' => $booklist_id]);
    }
}
