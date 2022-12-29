<?php

namespace App\Http\Controllers;

use App\Models\Activities;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;

class ActivitiesController extends Controller
{
    public function newActivity()
    {
        return view('activities.newactivity');
    }
    public function create(array $data)
    {
        return Activities::create([
            'currentUser' => Auth::user()->username,
            'SMSCount' => $data['SMSCount'],
            'status' => $data['status'],
            'remarks' => $data['remarks'],
        ]);
    }
    public function store(Request $request)
    {
        $data = $request->except('_method', '_token', 'submit');
        $check = $this->create($data);
        if ($record = Activities::firstOrCreate($data)) {
            Session::flash('message', 'Added Successfully');
            Session::flash('alert-class', 'alert-success');
            return redirect()->route('activities.personaldashboard');
        } else {
            Session::flash('message', 'Failed to add');
            Session::flash('alert-class', 'alert-danger');
        }
        return back();
    }
    public function updateActivity($id)
    {
        $activities = Activities::find($id);
        return view('activities.updateactivity')->with('activities', $activities);
    }
    public function update(Request $request, $id)
    {
        $data = $request->except('_method', '_token', 'submit');
        $activities = Activities::find($id);
        $activities->updatedBy = Auth::user()->username;
        if ($activities->update($data)) {
            Session::flash('message', 'Updated Successfully');
            Session::flash('alert-class', 'alert-success');
            return redirect()->route('activities.personaldashboard');
        } else {
            Session::flash('message', 'Failed to update');
            Session::flash('alert-class', 'alert-danger');
        }
        return back()->withInput();
    }
    public function dashboard()
    {
        $activities = Activities::select('id', 'currentUser', 'created_at', 'updatedBy', 'updated_at', 'SMSCount', 'status', 'remarks')->get();
        return view('dashboard')->with('activities', $activities);
    }
    public function search(Request $request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $activities = Activities::select('id', 'currentUser', 'created_at', 'updatedBy', 'updated_at', 'SMSCount', 'status', 'remarks')
            ->whereBetween('updated_at', [$startDate, $endDate])->orderBy('updated_at', 'DESC')->get();
        return view('activities.search')->with('activities', $activities);
    }
    public function searchpersonal(Request $request)
    {
        $startDate = $request->input('startDate');
        $endDate = $request->input('endDate');
        $activities = Activities::select('id', 'created_at', 'updatedBy', 'updated_at', 'SMSCount', 'status', 'remarks')
            ->whereBetween('updated_at', [$startDate, $endDate])->orderBy('updated_at', 'DESC')->get();
        return view('activities.searchpersonal')->with('activities', $activities);
    }
}