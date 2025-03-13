<?php
namespace App\Http\Controllers\Pet;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Services\Pet\PetService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Log;
use Inertia\Inertia;
use Inertia\Response;

class PetController extends Controller
{
    protected PetService $petService;

    public function __construct(PetService $petService)
    {
        $this->petService = $petService;
    }

    public function index()
    {
        $pets = $this->petService->getAllPets()->json();

        foreach ($pets as &$pet) {
            if (isset($pet['id'])) {
                $pet['id'] = (string) $pet['id'];
            }
        }

        return Inertia::render("pets/Index", [
            "pets" => $pets,
        ]);
    }

    public function destroy($id)
    {
        try {
            $response = $this->petService->deletePet((int) $id);

            return redirect()->route("pets.index")
                ->with('success', 'Pet deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route("pets.index")
                ->with('error', 'Failed to delete pet: ' . $e->getMessage());
        }
    }

    public function show($id)
    {
        try {
            $pet = $this->petService->getPetById($id)->json();

            if (isset($pet['id'])) {
                $pet['id'] = (string) $pet['id'];
            }

            return Inertia::render("pets/Show", [
                "pet" => $pet,
            ]);
        } catch (\Exception $e) {
            return redirect()->route('pets.index')
                ->with('error', 'Pet not found: ' . $e->getMessage());
        }
    }

    public function create()
    {
        return Inertia::render("pets/Create");
    }

    public function store(Request $request)
    {
        try {
            $petData = $request->validate([
                'name' => 'required|string',
                'status' => 'required|string|in:available,pending,sold',
                'category' => 'nullable|array',
                'category.id' => 'nullable|integer',
                'category.name' => 'nullable|string',
                'photoUrls' => 'nullable|array',
                'photoUrls.*' => 'nullable|string|url',
                'tags' => 'nullable|array',
            ]);

            $response = $this->petService->createPet($petData);

            return redirect()->route("pets.index")
                ->with('success', 'Pet created successfully');
        } catch (\Exception $e) {
            return back()->withErrors([
                'name' => 'Failed to create pet: ' . $e->getMessage()
            ])->withInput();
        }
    }

    public function edit($id)
    {
        try {
            $pet = $this->petService->getPetById($id)->json();

            if (isset($pet['id'])) {
                $pet['id'] = (string) $pet['id'];
            }

            return Inertia::render("pets/Edit", [
                "pet" => $pet,
            ]);
        } catch (\Exception $e) {
            return redirect()->route('pets.index')
                ->with('error', 'Pet not found: ' . $e->getMessage());
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $petData = $request->validate([
                'id' => 'required|string',
                'name' => 'required|string',
                'status' => 'required|string|in:available,pending,sold',
                'category' => 'nullable|array',
                'category.id' => 'nullable|integer',
                'category.name' => 'nullable|string',
                'photoUrls' => 'nullable|array',
                'photoUrls.*' => 'nullable|string|url',
                'tags' => 'nullable|array',
            ]);

            $petData['id'] = (int) $petData['id'];

            $response = $this->petService->updatePet($petData);

            return redirect()->route("pets.show", $id)
                ->with('success', 'Pet updated successfully');
        } catch (\Exception $e) {
            return back()->withErrors([
                'name' => 'Failed to update pet: ' . $e->getMessage()
            ])->withInput();
        }
    }
}
