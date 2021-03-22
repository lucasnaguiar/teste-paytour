<?php

namespace App\Http\Controllers;

use App\Http\Requests\ResumeFormRequest;
use App\Mail\ResumeSent;
use App\Models\PersonResume;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ResumeController extends Controller
{

    public function index()
    {
        $resumes = PersonResume::all();

        $this->respond($resumes);
    }

    public function store(ResumeFormRequest $request)
    {

       $resume = PersonResume::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'required_position' => $request->position,
            'education_level_id' => $request->educationLevelId,
            'obs' => $request->obs,
            'file' => $request->file('selectedFile')->storeAs('resumes', $this->getFileName($request->name, $request->selectedFile->extension())),
            'host_ip_address' => $request->ip(),
        ]);

        $resume->load('educationLevel');

        Mail::send(new ResumeSent($resume));

        session()->flash('status', 'success');

        return $this->respondCreated($resume);
    }

    public function getFileName($personName, $extension)
    {
        $date =  Carbon::now()->format('d-m-Y H_i_s');
        $name = Str::snake($personName . $date) . '.'.$extension;
        return $name;
    }
}
