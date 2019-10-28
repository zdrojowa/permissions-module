<?php

namespace Selene\Modules\PermissionsModule\Http\Controllers;

use Illuminate\Http\Request;
use Selene\Models\PermissionPackage;
use Selene\Modules\DashboardModule\ZdrojowaTable;
use Selene\Modules\PermissionsModule\Http\Requests\PermissionsStoreRequest;
use Selene\Modules\PermissionsModule\Http\Requests\PermissionsUpdateRequest;
use Selene\Support\Facades\Core;

class PermissionsController
{

    public function index()
    {
        return view('PermissionsModule::list');
    }

    public function ajax(Request $request)
    {
        return ZdrojowaTable::response(PermissionPackage::query(), $request);
    }

    public function create()
    {
        return view('PermissionsModule::add', ['presences' => Core::aclRepository()->getPresences()]);
    }

    public function store(PermissionsStoreRequest $request)
    {
        $request->merge(['anchors' => json_decode($request->input('anchors'))]);
        PermissionPackage::create($request->all());

        $request->session()->flash('alert-success', 'Paczka uprawnień została pomyślnie utworzona');
        return redirect()->route('PermissionsModule::permissions.create');
    }

    public function edit(PermissionPackage $permission)
    {
        return view('PermissionsModule::edit', ['presences' => Core::aclRepository()->getPresences(), 'package' => $permission]);
    }

    public function update(PermissionsUpdateRequest $request, PermissionPackage $permission)
    {
        $request->merge(['anchors' => json_decode($request->input('anchors'))]);
        $permission->update($request->all());

        $request->session()->flash('alert-success', 'Paczka uprawnień została pomyślnie zaktualizowana');
        return redirect()->route('PermissionsModule::permissions.edit', ["permission" => $permission]);
    }

    public function destroy(PermissionPackage $permission)
    {
        $permission->delete();
    }
}
