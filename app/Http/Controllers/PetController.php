<?php

namespace App\Http\Controllers;

use App\Helpers\Uploader;
use App\Http\Requests\PetRequest;
use App\Models\Pet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::query()
            ->with('category', 'tags')
            ->orderByDesc('created_at')
            ->get();

        return response()->json($pets, 200);
    }

    public function findByStatus(Request $request)
    {
        $pets = Pet::query()
            ->where('status', $request->status)
            ->with('category', 'tags')
            ->get();
        return response()->json($pets, 200);
    }


    public function show(Pet $pet)
    {
        return response()->json($pet->load('category', 'tags'), 200);
    }

    public function store(PetRequest $request)
    {

        $data = DB::transaction(function () use ($request) {

            $file = "";

            if ($request->hasFile('photoUrls')) {
                $file = Uploader::uploadFile('photoUrls', 'pets');
            }

            $pet = Pet::create([
                'name' => $request->name,
                'category_id' => $request->category_id,
                'status' => $request->status,
                'photoUrls' => $file,
            ]);

            if ($request->tags) {
                $pet->tags()->attach(explode(",", $request->tags));
            }

            return $pet->load('category', 'tags');


        });
        return response()->json($data, 201);
    }


    public function update(PetRequest $request, Pet $pet)
    {
        $data = DB::transaction(function () use ($request, $pet) {

            $file = $pet->photoUrls;
            if ($request->hasFile('photoUrls')) {
                if ($pet->photoUrls) {
                    Uploader::removeFile("pets", $pet->photoUrls);
                }
                $file = Uploader::uploadFile('photoUrls', 'pets');
            }

            $pet->name = $request->name;
            $pet->status = $request->status;
            $pet->category_id = $request->category_id;
            $pet->photoUrls = $file;
            $pet->save();

            if ($request->tags) {
                $pet->tags()->sync(explode(",", $request->tags));
            } else {
                $pet->tags()->detach();
            }

            return $pet->load('category', 'tags');
        });

        return response()->json($data, 201);
    }

    public function destroy(Pet $pet)
    {
        if ($pet->photoUrls) {
            if ($pet->photoUrls != "pet_default.png") {
                Uploader::removeFile("pets", $pet->photoUrls);
            }
        }
        $pet->delete();
        return response()->json("delete success", 201);
    }
}
