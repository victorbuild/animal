<?php

namespace App\Http\Controllers\Api;

use App\Animal;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Http\Resources\AnimalResource;
use Auth;
use App\Http\Requests\StoreAnimalRequest;
use App\Services\AnimalService;
use App\Http\Controllers\Controller;

class AnimalController extends Controller
{
    private $animalService;

    public function __construct(AnimalService $animalService)
    {
        $this->animalService = $animalService;
        $this->middleware('auth:api', ['except' => ['index','show']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // 設定預設值

        $marker = isset($request->marker) ? $request->marker : 1;
        $limit = isset($request->limit) ? $request->limit : 10;

        $query = Animal::query();

        $query = $this->animalService->filterAnimals($request->filters, $query);
        
        $query = $this->animalService->sortAnimals($request->sort, $query);

        $animals = $query->where('id', '>=', $marker)->paginate($limit);

        return response($animals, Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\StoreAnimalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAnimalRequest $request)
    {
        $animal = Animal::create($request->all());
        return response($animal, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function show(Animal $animal)
    {
        return response(new AnimalResource($animal), Response::HTTP_OK);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function edit(Animal $animal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Animal $animal)
    {
        $animal->update($request->all());
        return response($animal, Response::HTTP_OK);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Animal $animal)
    {
        $animal->delete();
        return response(null, Response::HTTP_NO_CONTENT);
    }

    /**
     * 動物加入或移除我的最愛
     *
     * @param  \App\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function like(Animal $animal)
    {
        $animal->like()->toggle(Auth::user()->id);

        return response(null, Response::HTTP_NO_CONTENT);
    }

}
