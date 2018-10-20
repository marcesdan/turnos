<?php
/**
 * Created by PhpStorm.
 * PacienteRequest: marces
 * Date: 15/08/18
 * Time: 09:34
 */

namespace App\Services;

use App\Paciente;

/**
 * Class PacienteService
 * @package App\Services
 */
class PacienteService
{
    /** Retorna todos los pacientes del sistema
     * @return Paciente[]|\Illuminate\Database\Eloquent\Collection
     */
    public function findAll()
    {
        return Paciente::all();
    }

    /** Retorna el paciente por su id
     * @param $id
     * @return mixed
     */
    public function find($id)
    {
        return Paciente::findOrFail($id);
    }

    /** Retorna el paciente por su documento
     * @param $documento
     * @return mixed
     */
    public function findByDocumento($documento)
    {
        return Paciente::where('documento', $documento)->first();
    }

    /** Persiste al paciente
     * @param $input
     */
    public function store($input) {
        return Paciente::create($input);
    }

    /** Actualiza al paciente
     * @param $input
     * @param Paciente $paciente
     */
    public function update($input, Paciente $paciente)
    {
        $paciente->fill($input);
        $paciente->save();
        return $paciente;
    }

    /** Elimina el paciente dado
     * @param Paciente $paciente
     * @return bool|null
     * @throws \Exception
     */
    public function destroy(Paciente $paciente)
    {
        return $paciente->delete();
    }
}
