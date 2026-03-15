<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudyMaterialRequest;
use App\Http\Requests\StudySubjectRequest;
use App\Models\StudyMaterial;
use App\Models\StudySubject;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ScholeController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->string('q'));

        $subjects = StudySubject::query()
            ->with('user')
            ->withCount('materials')
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($innerQuery) use ($search) {
                    $innerQuery
                        ->where('name', 'like', "%{$search}%")
                        ->orWhere('related_course', 'like', "%{$search}%")
                        ->orWhere('science_field', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(12)
            ->withQueryString();

        return view('schole.index', [
            'subjects' => $subjects,
            'search' => $search,
        ]);
    }

    public function createSubject(): View
    {
        return view('schole.subjects.create');
    }

    public function storeSubject(StudySubjectRequest $request): RedirectResponse
    {
        $subject = Auth::user()->studySubjects()->create($request->validated());

        return redirect()->route('schole.show', $subject)
            ->with('success', 'Matéria criada com sucesso.');
    }

    public function show(StudySubject $subject): View
    {
        $subject->load([
            'user',
            'materials.user',
        ]);

        return view('schole.show', [
            'subject' => $subject,
        ]);
    }

    public function createMaterial(StudySubject $subject): View
    {
        return view('schole.materials.create', [
            'subject' => $subject,
        ]);
    }

    public function storeMaterial(StudyMaterialRequest $request, StudySubject $subject): RedirectResponse
    {
        $validated = $request->validated();
        $payload = [
            'title' => $validated['title'],
            'description' => $validated['description'],
            'type' => $validated['type'],
            'external_url' => $validated['type'] === 'link' ? $validated['external_url'] : null,
        ];

        if ($validated['type'] === 'upload') {
            $file = $request->file('file');
            $storedPath = $file->store('schole-materials/'.Str::slug($subject->name), 'public');

            $payload = array_merge($payload, [
                'file_path' => $storedPath,
                'file_name' => $file->getClientOriginalName(),
                'file_extension' => strtolower($file->getClientOriginalExtension()),
                'file_size' => $file->getSize(),
            ]);
        }

        $subject->materials()->create($payload + [
            'user_id' => Auth::id(),
        ]);

        return redirect()->route('schole.show', $subject)
            ->with('success', 'Material publicado com sucesso.');
    }

    public function downloadMaterial(StudyMaterial $material): BinaryFileResponse
    {
        abort_unless($material->type === 'upload' && $material->file_path, 404);
        abort_unless(Storage::disk('public')->exists($material->file_path), 404);

        return response()->download(
            Storage::disk('public')->path($material->file_path),
            $material->file_name ?? basename($material->file_path)
        );
    }
}
