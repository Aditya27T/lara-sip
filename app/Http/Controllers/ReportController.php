<?php

namespace App\Http\Controllers;

use App\Models\report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try{
            $report = Report::get();
            return response()->json(
                $report->map(function ($report) {
                    return [
                        'id' => $report->id,
                        'title' => $report->title,
                        'description' => $report->description,
                        'image' => $report->image,
                        'status' => $report->status,
                        'location' => $report->location,
                        'category' => $report->category,
                        'votes' => $report->votes,
                        'report-status' => $report->report_status,
                        'user' => $report->user->name
                    ];
                })
            );
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
            $report = new Report();
            $report->user_id = $request->user_id;
            $report->title = $request->title;
            $report->description = $request->description;
            $report->image = $request->image;
            $report->status = $request->status;
            $report->location = $request->location;
            $report->category = $request->category;
            $report->save();
            return response()->json(['message' => 'Report created successfully']);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }   
    }


    // calculate the total number of votes from the votes table
    public function calculateVotes($reportId)
    {
        $votes = Reportvote::where('report_id', $reportId)->get();
        $totalVotes = 0;

        foreach ($votes as $vote) {
            $totalVotes += $vote->vote;
        }

        return $totalVotes;
    }
    /**
     * Display the specified resource.
     */
    public function show(report $report)
    {
        try {
            $report = Report::find($id);
            return response()->json(
                [
                    'id' => $report->id,
                    'title' => $report->title,
                    'description' => $report->description,
                    'image' => $report->image,
                    'status' => $report->status,
                    'location' => $report->location,
                    'category' => $report->category,
                    'votes' => $this->calculateVotes($report->id),
                    'report-status' => $report->report_status,
                    'user' => $report->user->name,
                    'progress' => $report->progress->map(function ($progress) {
                        return [
                            'id' => $progress->id,
                            'description' => $progress->description,
                            'image' => $progress->image,
                            'status' => $progress->status,
                            'created_at' => $progress->created_at
                        ];
                    }),
                    'votes' => $report->votes->map(function ($vote) {
                        return [
                            'id' => $vote->id,
                            'user' => $vote->user->name,
                            'vote' => $vote->vote
                        ];
                    })
                ]
            );
        } catch (\Exception $e) {
            return response()->json(['message' => 'Error: ' . $e->getMessage()], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, report $report)
    {
        $report = Report::find($id);
        $report->status = $request->status;
        $report->save();

        return response()->json(['message' => 'Report updated successfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(report $report)
    {
        $report = Report::find($id);

        if ($report->report_status === 'approved') {
            return response()->json(['message' => 'Report cannot be deleted because it has been approved'], 400);
        }

        $report->delete();

        return response()->json(['message' => 'Report deleted successfully']);
    }
}
