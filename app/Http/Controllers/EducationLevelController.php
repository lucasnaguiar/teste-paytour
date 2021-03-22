<?php

namespace App\Http\Controllers;

use App\Http\Resources\EducationLevelCollection;
use App\Models\EducationLevel;
use Illuminate\Http\Request;

class EducationLevelController extends Controller
{
    public function index()
    {
        $levels = EducationLevel::all();
        return new EducationLevelCollection($levels);
    }
}
