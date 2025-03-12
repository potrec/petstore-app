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
}
