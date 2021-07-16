<?php

namespace App\Http\Controllers;

use App\Models\Character;
use App\Repositories\CharacterRepository;
use Illuminate\Support\Facades\Request;
use App\Http\Controllers\AppBaseController;
use App\Http\Resources\CharacterResource;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;


/**
 * Class CharacterController
 * @package App\Http\Controllers
 */
class CharacterController extends AppBaseController
{
    /** @var  CharacterRepository */
    private $characterRepository;

    public function __construct(CharacterRepository $characterRepo)
    {
        $this->characterRepository = $characterRepo;
    }

    /**
     * Display a listing of the Character.
     * GET|HEAD /characters
     *
     * @return Inertia
     */
    public function index()
    {
        $characters = $this->characterRepository->index(Request::all())->appends(Request::except('page'));

        return Inertia::render('Characters/Index', [
            'genders' => $characters->map(function ($character) {
                            return $character->gender;
                        })->unique(),
            'filters' => Request::all('name', 'gender'),
            'characters' => CharacterResource::collection($characters),
        ]);

    }

    /**
     * Display the specified Character.
     * GET|HEAD /characters/{character}
     *
     * @param Character $character
     *
     * @return Inertia
     */
    public function edit(Character $character)
    {
        return Inertia::render('Characters/Edit', [
            'character' => new CharacterResource($character)
        ]);
    }

    /**
     * Display the specified Character.
     * PUT|HEAD /characters/{character}
     *
     * @param Character $character
     *
     * @return Inertia
     */
    public function update(Character $character)
    {
        $this->characterRepository->update(
            Request::validate([
                'name' => ['required', 'max:100'],
                'gender' => ['required', 'max:50'],
                'culture' => ['nullable', 'max:50'],
                'birth_year' => ['nullable', 'max:10'],
                'died_year' => ['nullable', 'max:10'],
            ]),
            $character->id
        );

        return Redirect::back()->with('success', 'Character updated.');
    }



}
