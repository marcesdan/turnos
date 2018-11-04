<?php

namespace App\Http\Controllers;

use App\Http\Requests\MedicoRequest;
use App\Http\Requests\UserRequest;
use App\Services\ProfileService;
use App\User;
use Illuminate\Support\Facades\Auth;


/**
 * Class ProfileController
 * @package App\Http\Controllers
 */
class ProfileController extends Controller
{

    /**
     * @var ProfileService
     */
    protected $profileService;

    /**
     * ProfileController constructor.
     * @param ProfileService $profileService
     */
    public function __construct(ProfileService $profileService)
    {
        $this->profileService = $profileService;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit()
    {
        $user = Auth::user();
        $role = $user->role->nombre;

        switch ($role) {
            case 'Médico':
                return $this->editMedico($user->medico);
            default:
                return $this->editUser($user);

        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $medico
     * @return \Illuminate\Http\Response
     */
    private function editMedico($medico)
    {
        // un médico podría cambiar su especialidad...
        $especialidades = $this->profileService->findAllEspecialidades();
        return view('profile.medico-edit', [
            'medico' => $medico,
            'especialidades' => $especialidades
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param $user
     * @return \Illuminate\Http\Response
     */
    private function editUser($user)
    {
        //$user = $this->profileService->findUser($user->id);
        return view('profile.user-edit', [
            'user' => $user,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param MedicoRequest $request
     * @return \Illuminate\Http\Response
     */
    public function updateMedico(MedicoRequest $request)
    {
        $medico = Auth::user()->medico;
        $validatedData = $request->validated();
        $this->profileService->updateMedico($validatedData, $medico);
        return redirect('/')->with('status', 'Perfil editado con éxito!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UserRequest $request
     * @return \Illuminate\Http\Response
     */
    public function updateUser(UserRequest $request)
    {
        $user = Auth::user();
        $validatedData = $request->validated();
        $this->profileService->updateUser($validatedData, $user);
        return redirect('/')->with('status', 'Perfil editado con éxito!');
    }
}
