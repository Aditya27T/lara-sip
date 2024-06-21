<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function UserGet()
    {
        $users = User::get();
        return response()->json($users);
    }

    public function UpdateReportStatus(Request $request)
    {
        $report = Report::find($request->id);
        $report->status = $request->status;
        $report->save();
        return response()->json($report);
    }

    public function DeleteReport(Request $request)
    {
        $report = Report::find($request->id);
        $report->delete();
        return response()->json(['message' => 'Report deleted successfully']);
    }

    public function DeleteUser(Request $request)
    {
        $user = User::find($request->id);
        $user->delete();
        return response()->json(['message' => 'User deleted successfully']);
    }

    public function UpdateUserStatus(Request $request)
    {
        $user = User::find($request->id);
        $user->status = $request->status;
        $user->save();
        return response()->json($user);
    }

    public function UpdateStatusReport(Request $request)
    {
        $report = Report::find($request->id);
        $report->report_status = $request->report_status;   
        $report->save();
        return response()->json($report);
    }

    public function UpdateVote(Request $request)
    {
        $reportvote = Reportvote::find($request->id);
        $reportvote->vote = $request->vote;
        $reportvote->save();
        return response()->json($reportvote);
    }

    public function DeleteVote(Request $request)
    {
        $reportvote = Reportvote::find($request->id);
        $reportvote->delete();
        return response()->json(['message' => 'Vote deleted successfully']);
    }

    public function UpdateProgress(Request $request)
    {
        $progress = Progress::find($request->id);
        $progress->status = $request->status;
        $progress->image = $request->image;
        $progress->save();
        return response()->json($progress);
    }
}
