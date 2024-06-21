<?php

namespace App\Http\Controllers;

use App\Models\reportvote;
use Illuminate\Http\Request;

class ReportvoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $reportvote = Reportvote::get();
            return response()->json($reportvote);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $reportvote = new Reportvote();
            $reportvote->user_id = $request->user_id;
            $reportvote->report_id = $request->report_id;
            $reportvote->vote = $request->vote;
            $reportvote->save();
            return response()->json(['message' => 'Vote created successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(reportvote $reportvote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(reportvote $reportvote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, reportvote $reportvote)
    {
        $reportvote->vote = $request->vote;
        $reportvote->save();
        return response()->json(['message' => 'Vote updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(reportvote $reportvote)
    {
        $reportvote->delete();
        return response()->json(['message' => 'Vote deleted successfully']);
    }
}
