<?php

namespace App\Http\Controllers;

use App\Services\MedicoService;
use App\Services\UserService;
use App\Http\Requests\UserRequest;

/**
 * Class UserController
 * @package App\Http\Controllers
 */
class UserController extends Controller
{

    /**
     * @var UserService
     */
    protected $userService;
    /**
     * @var MedicoService
     */
    protected $medicoService;

    /**
     * UserController constructor.
     * @param UserService $userService
     * @param MedicoService $medicoService
     */
    public function __construct(UserService $userService, MedicoService $medicoService)
    {
        $this->userService = $userService;
        $this->medicoService = $medicoService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = $this->userService->findAll();
        return view('user.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $especialidades = $this->medicoService->findAllEspecialidades();
        return view('user.create', ['especialidades' => $especialidades]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = $this->userService->find($id);
        return view('user.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UserRequest
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = $this->userService->find($id);
        $validatedData = $request->validated();
        $this->userService->update($validatedData, $user);
        return redirect('/admin/usuario')->with('status', 'Usuario editado con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Exception
     */
    public function destroy($id)
    {
        $user = $this->userService->find($id);
        $this->userService->destroy($user);
        return response()->json(200);
    }
}
