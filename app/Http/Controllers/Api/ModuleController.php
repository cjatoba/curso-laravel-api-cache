<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUpdateModule;
use App\Http\Resources\ModuleResource;
use App\Services\ModuleService;

class ModuleController extends Controller
{
    protected $moduleService;

    public function __construct(ModuleService $moduleService){
        $this->moduleService = $moduleService;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  string  $course
     * @return \Illuminate\Http\Response
     */
    public function index($course)
    {
        $modules = $this->moduleService->getModulesByCourse($course);

        return ModuleResource::collection($modules);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param string $course
     * @return \Illuminate\Http\Response
     */
    public function store(StoreUpdateModule $request, $course)
    {
        $module = $this->moduleService->createNewModule($request->validated());

        return new ModuleResource($module);
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $course
     * @param  string  $identify
     * @return \Illuminate\Http\Response
     */
    public function show($course, $identify)
    {
        $module = $this->moduleService->getModuleByCourse($course, $identify);

        return new ModuleResource($module);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $course
     * @param  string  $identify
     * @return \Illuminate\Http\Response
     */
    public function update(StoreUpdateModule $request, $course, $identify)
    {
        $this->moduleService->updateModule($identify, $request->validated());
        return response()->json(['message' => 'updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $course
     * @param  int  $identify
     * @return \Illuminate\Http\Response
     */
    public function destroy($course, $identify)
    {
        $this->moduleService->deleteModule($identify);

        return response()->json([], 204);
    }
}
