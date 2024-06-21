<?php

namespace App\Http\Controllers;

use App\Models\progress;
use Illuminate\Http\Request;

class ProgressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $progress = Progress::get();
            return response()->json($progress);
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
            $progress = new Progress();
            $progress->report_id = $request->report_id;
            $progress->description = $request->description;
            $progress->image = $request->image;
            $progress->status = $request->status;
            $progress->save();
            if ($progress->status === 'approved') {
                $report = Report::find($progress->report_id);
                $report->report_status = 'approved';
                $report->save();
            } else if ($progress->status === 'ongoing') {
                $report = Report::find($progress->report_id);
                $report->report_status = 'ongoing';
                $report->save();
            }
            
            return response()->json(['message' => 'Progress created successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(progress $progress)
    {
        try {
            $progress = Progress::find($id);
            return response()->json($progress);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(progress $progress)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, progress $progress)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(progress $progress)
    {
        //==
    }
}
