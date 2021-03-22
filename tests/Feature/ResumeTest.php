<?php

namespace Tests\Feature;

use App\Models\PersonResume;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ResumeTest extends TestCase
{
    /**
     * @test
     */
    public function submeter_com_dados_validos()
    {
        $resume = PersonResume::factory()->make();
        Storage::fake('test_resumes');
        $file = UploadedFile::fake()->create(
            'document.pdf', 500, 'application/pdf'
        );
        $this->withHeaders([
            'Accept' => 'application/json',

        ])->json('POST', 'api/resume', [
            'name' => $resume->name,
            'email' => $resume->email,
            'phone' => $resume->phone,
            'position' => $resume->required_position,
            'educationLevelId' => $resume->education_level_id,
            'obs' => $resume->obs,
            'selectedFile' => $file,
        ])->assertStatus(201);

    }
    /**
     * @test
     */
    public function submeter_com_arquivo_em_formato_invalido()
    {
        $resume = PersonResume::factory()->make();
        Storage::fake('test_resumes');
        $file = UploadedFile::fake()->image('resume.jpg');

        $this->withHeaders([
            'Accept' => 'application/json',

        ])->json('POST', 'api/resume', [
            'name' => $resume->name,
            'email' => $resume->email,
            'phone' => $resume->phone,
            'position' => $resume->required_position,
            'educationLevelId' => $resume->education_level_id,
            'obs' => $resume->obs,
            'selectedFile' => $file,
        ])->assertStatus(422);

    }
    /**
     * @test
     */
    public function submeter_com_arquivo_maior_que_1_mb()
    {
        $resume = PersonResume::factory()->make();
        Storage::fake('test_resumes');
        $file = UploadedFile::fake()->create(
            'document.pdf', 1523, 'application/pdf'
        );
        $this->withHeaders([
            'Accept' => 'application/json',

        ])->json('POST', 'api/resume', [
            'name' => $resume->name,
            'email' => $resume->email,
            'phone' => $resume->phone,
            'position' => $resume->required_position,
            'educationLevelId' => $resume->education_level_id,
            'obs' => $resume->obs,
            'selectedFile' => $file,
        ])->assertStatus(422);
    }
}
