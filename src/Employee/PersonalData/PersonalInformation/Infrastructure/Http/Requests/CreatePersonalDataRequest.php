<?php

namespace Src\Employee\PersonalData\PersonalInformation\Infrastructure\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Src\Employee\PersonalData\PersonalInformation\Application\DTOs\CreatePersonalDataDTO;

final class CreatePersonalDataRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'actualContract' => 'nullable|string',
            'dateContractFinish' => 'nullable|date',
            'name' => 'required|string|max:255',
            'lastName' => 'required|string|max:255',
            'activo' => 'nullable|integer',
            'id_check' => 'nullable|date',
            'direction' => 'nullable|string',
            'cp' => 'nullable|integer',
            'phone' => 'nullable|string',
            'birthday' => 'nullable|date',
            'rfc' => 'nullable|string',
            'curp' => 'nullable|string',
            'nss' => 'nullable|string',
            'school' => 'nullable|string',
            'ine' => 'nullable|string',
            'alergist' => 'nullable|string',
            'personalContact' => 'nullable|string',
            'phoneContact' => 'nullable|string',
            'empresa' => 'nullable|string',
            'ingreso' => 'nullable|date',
            'id_empleado' => 'nullable|integer',
            'id_jefe_inmediato' => 'nullable|integer',
            'id_departamento' => 'nullable|integer',
            'id_puesto' => 'nullable|integer',
            'inmBoss' => 'nullable|string',
            'wArea' => 'nullable|string',
            'infonavit' => 'nullable|string',
            'numCart' => 'nullable|string',
            'company' => 'nullable|string',
            'idLicNum' => 'nullable|string',
            'documents' => 'nullable|string',
            'contracts' => 'nullable|array',
            'documentsCompany' => 'nullable|string',
            'removeColaborator' => 'nullable|string',
            'img' => 'nullable|string',
            'numExt' => 'nullable|string',
            'utalla' => 'nullable|string',
            'numCarttwo' => 'nullable|string',
            'email' => 'nullable|email',
            'emailCompany' => 'nullable|email',
            'checkCode' => 'nullable|string',
            'ext_tel' => 'nullable|string',
            'created_by' => 'nullable|integer',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre es requerido',
            'lastName.required' => 'El apellido es requerido',
        ];
    }

    public function toDTO(): CreatePersonalDataDTO
    {
        return new CreatePersonalDataDTO(
            actualContract: $this->actualContract,
            dateContractFinish: $this->dateContractFinish,
            name: $this->name,
            lastName: $this->lastName,
            activo: $this->activo,
            idCheck: $this->id_check,
            direction: $this->direction,
            cp: $this->cp,
            phone: $this->phone,
            birthday: $this->birthday,
            rfc: $this->rfc,
            curp: $this->curp,
            nss: $this->nss,
            school: $this->school,
            ine: $this->ine,
            alergist: $this->alergist,
            personalContact: $this->personalContact,
            phoneContact: $this->phoneContact,
            empresa: $this->empresa,
            ingreso: $this->ingreso,
            idEmpleado: $this->id_empleado,
            idJefeInmediato: $this->id_jefe_inmediato,
            idDepartamento: $this->id_departamento,
            idPuesto: $this->id_puesto,
            inmBoss: $this->inmBoss,
            wArea: $this->wArea,
            infonavit: $this->infonavit,
            numCart: $this->numCart,
            company: $this->company,
            idLicNum: $this->idLicNum,
            documents: $this->documents,
            contracts: $this->contracts,
            documentsCompany: $this->documentsCompany,
            removeColaborator: $this->removeColaborator,
            img: $this->img,
            numExt: $this->numExt,
            utalla: $this->utalla,
            numCarttwo: $this->numCarttwo,
            email: $this->email,
            emailCompany: $this->emailCompany,
            checkCode: $this->checkCode,
            extTel: $this->ext_tel,
            createdBy: $this->created_by,
        );
    }
}
