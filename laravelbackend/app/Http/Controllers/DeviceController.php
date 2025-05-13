<?php

namespace App\Http\Controllers;

use App\Models\Device;
use Illuminate\Http\Request;

class DeviceController extends Controller
{
    public function index()
    {
        return Device::with('readings')->paginate(10);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required|string|max:255',
            'device_id' => 'required|string|unique:devices'
        ]);

        return Device::create($validated);
    }

    public function show($id)
    {
        return Device::with('readings')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $device = Device::findOrFail($id);
        $validated = $request->validate([
            'name' => 'sometimes|string|max:255',
            'location' => 'sometimes|string|max:255'
        ]);

        $device->update($validated);
        return $device;
    }

    public function destroy($id)
    {
        Device::findOrFail($id)->delete();
        return response(null, 204);
    }
}