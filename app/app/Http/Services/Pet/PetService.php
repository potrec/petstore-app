<?php

namespace App\Http\Services\Pet;

use App\Http\Services\Service;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Client\Response;

class PetService extends Service
{
    protected string $baseUrl;

    public function __construct()
    {
        $this->baseUrl = config("services.petstore.url");
    }

    public function getAllPets()
    {
        return Http::get("{$this->baseUrl}/pet/findByStatus", [
            "status" => "available",
        ]);
    }

    public function deletePet(int $petId): Response
    {
        return Http::delete("{$this->baseUrl}/pet/{$petId}");
    }
}
