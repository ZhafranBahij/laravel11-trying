<?php

namespace App\Http\Controllers;

use App\Models\Myschedule;
use App\Http\Requests\StoreMyscheduleRequest;
use App\Http\Requests\UpdateMyscheduleRequest;

class MyscheduleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $schedules = Myschedule::query()
                    ->with(['User'])
                    ->latest()
                    ->get();

        return view('schedule.index', [
            'schedules' => $schedules,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('schedule.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreMyscheduleRequest $request)
    {
        try {
            $validated = $request->validated();
            $validated['user_id'] = auth()->user()->id;
            Myschedule::create($validated);
            return redirect('/schedule')->with('success', 'Data has been created');
        } catch (\Throwable $th) {
            return redirect();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Myschedule $myschedule)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Myschedule $schedule)
    {
        return view('schedule.edit', [
            'schedule' => $schedule,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMyscheduleRequest $request, Myschedule $schedule)
    {
        try {
            $validated = $request->validated();
            $validated['user_id'] = auth()->user()->id;
            $schedule->update($validated);
            return redirect('/schedule')->with('success', 'Data has been updated');
        } catch (\Throwable $th) {
            return redirect();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Myschedule $schedule)
    {
        $schedule->delete();
        return redirect()->back()->with('success', 'Data has been deleted');
    }
}
