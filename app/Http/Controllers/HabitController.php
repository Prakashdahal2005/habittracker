<?php

namespace App\Http\Controllers;

use App\Models\Habit;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HabitController extends Controller
{
    public function handle(Request $request)
    {
        // Add new habit
        if ($request->isMethod('post')) {
            $request->validate([
                'name' => 'required|string|max:255'
            ]);

            $habit = new Habit;
            $habit->name = $request->name;
            $habit->status = 'pending';
            $habit->save();
        }

        // Update status
        if ($request->isMethod('patch')) {
            $habit = Habit::find($request->id);
            if ($habit) {
                $request->validate([
                    'status' => 'required|in:pending,done,skipped'
                ]);
                $habit->status = $request->status;
                $habit->save();
            }
        }

        // Delete habit
        if ($request->isMethod('delete')) {
            $habit = Habit::find($request->id);
            if ($habit) $habit->delete();
        }

        // Fetch all habits
        $habits = Habit::all();
        return view('habits', compact('habits'));
    }
}

