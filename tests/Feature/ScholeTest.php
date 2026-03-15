<?php

use App\Models\StudySubject;
use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('schole index can be rendered', function () {
    $this->withoutVite();

    $subject = StudySubject::create([
        'name' => 'Fundamentos de Microeconomia',
        'slug' => 'fundamentos-de-microeconomia',
        'related_course' => 'Economia',
        'science_field' => 'CSA',
        'description' => 'Bases introdutórias de análise microeconômica.',
        'user_id' => User::factory()->create()->id,
    ]);

    $response = $this->get(route('schole.index'));

    $response->assertOk();
    $response->assertSee($subject->name);
});

test('authenticated user can create a study subject', function () {
    $user = User::factory()->create();

    $response = $this
        ->withoutVite()
        ->actingAs($user)
        ->post(route('schole.subjects.store'), [
            'name' => 'Estatística',
            'related_course' => 'Administração',
            'science_field' => 'CSA',
            'description' => 'Probabilidade, inferência e análise descritiva.',
        ]);

    $response->assertRedirect();

    $this->assertDatabaseHas('study_subjects', [
        'name' => 'Estatística',
        'slug' => 'estatistica',
        'related_course' => 'Administração',
        'science_field' => 'CSA',
        'user_id' => $user->id,
    ]);
});

test('authenticated user can upload a study material', function () {
    Storage::fake('public');

    $user = User::factory()->create();
    $subject = StudySubject::create([
        'name' => 'Contabilidade Empresarial',
        'slug' => 'contabilidade-empresarial',
        'related_course' => 'Ciências Contábeis',
        'science_field' => 'CSA',
        'description' => 'Lançamentos, demonstrações e análise contábil.',
        'user_id' => $user->id,
    ]);

    $response = $this
        ->withoutVite()
        ->actingAs($user)
        ->post(route('schole.materials.store', $subject), [
            'title' => 'Lista 1 de exercícios',
            'description' => 'Material introdutório com exercícios resolvidos.',
            'type' => 'upload',
            'file' => UploadedFile::fake()->create('lista-1.pdf', 120, 'application/pdf'),
        ]);

    $response->assertRedirect(route('schole.show', $subject));

    $this->assertDatabaseHas('study_materials', [
        'study_subject_id' => $subject->id,
        'user_id' => $user->id,
        'title' => 'Lista 1 de exercícios',
        'type' => 'upload',
    ]);

    expect(Storage::disk('public')->allFiles('schole-materials/contabilidade-empresarial'))
        ->toHaveCount(1);
});

test('uploaded study material can be downloaded through the application route', function () {
    Storage::fake('public');

    $user = User::factory()->create();
    $subject = StudySubject::create([
        'name' => 'Gestao de Processos',
        'slug' => 'gestao-de-processos',
        'related_course' => 'Administracao',
        'science_field' => 'CSA',
        'description' => 'Mapeamento e melhoria de processos.',
        'user_id' => $user->id,
    ]);

    $path = UploadedFile::fake()->create('guia-processos.pdf', 120, 'application/pdf')
        ->store('schole-materials/gestao-de-processos', 'public');

    $material = $subject->materials()->create([
        'user_id' => $user->id,
        'title' => 'Guia de processos',
        'description' => 'Arquivo de apoio.',
        'type' => 'upload',
        'file_path' => $path,
        'file_name' => 'guia-processos.pdf',
        'file_extension' => 'pdf',
        'file_size' => 120 * 1024,
    ]);

    $response = $this
        ->withoutVite()
        ->get(route('schole.materials.download', $material));

    $response->assertOk();
    $response->assertHeader('content-disposition', 'attachment; filename=guia-processos.pdf');
});
