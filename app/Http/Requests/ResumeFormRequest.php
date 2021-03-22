<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ResumeFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required','max:255'],
            'email' => ['required'],
            'phone' => ['required', 'regex:/^\([0-9]{2}\) [0-9]?[0-9]{4}-[0-9]{4}$/'],
            'position' => ['required'],
            'educationLevelId' => ['required'],
            'obs' => [],
            'selectedFile' => ['file','max:1024','mimes:doc,docx,pdf'],
        ];
    }

    public function attributes()
    {
        return [
            'name' => 'Nome',
            'email' => 'E-mail',
            'phone' => 'Telefone',
            'position' => 'Cargo Desejado',
            'educationLevelId' => 'Escolaridade',
            'obs' => 'Observações',
            'cv_file' => 'Arquivo Curriculum Vitae',
        ];
    }
}
