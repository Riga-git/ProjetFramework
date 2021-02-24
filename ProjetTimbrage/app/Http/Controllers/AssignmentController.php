<?php

namespace App\Http\Controllers;

use Inertia\Inertia;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class AssignmentController extends Controller
{
    public function index($date)
    {
        return Inertia::render('Assignments', [ 'date' => $date]);
    }

    public function edit($assignment)
    {
        return Inertia::render('Assignments', [ 'assignment' => $assignment]);
    }

    public function store($assignment)
    {
        
    }

    public function destroy($assignment)
    {
        
    }
}
