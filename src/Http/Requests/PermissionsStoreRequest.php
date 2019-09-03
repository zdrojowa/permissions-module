<?php

namespace Selene\Modules\PermissionsModule\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Selene\Support\Config\Config;
use Selene\Support\Enums\Core\Core;

class PermissionsStoreRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:250|unique:'.Config::get(Core::PERMISSIONS_TABLE).',name',
            'anchors' => 'required|json'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Te pole jest wymagane.',
            'name.max' => 'Nazwa może mieć maksymalnie 250 znaków.',
            'name.string' => 'Nazwa jest nieprawidłowa.',
            'name.unique' => 'Nazwa musi być unikalna',
            'anchors.required' => 'Te pole jest wymagane.',
            'anchors.json' => 'Wystąpił błąd skryptu skontaktuj się z programistami'
        ];
    }
}
