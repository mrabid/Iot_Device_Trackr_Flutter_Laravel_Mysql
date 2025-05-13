<?php

namespace App\Http\Controllers;

use App\Models\DeviceReading;
use Illuminate\Http\Request;

class DeviceReadingController extends Controller
{
    public function index($deviceId)
    {
        return DeviceReading::where('device_id', $deviceId)->paginate(50);
    }

    public function allReadings()
    {
        return DeviceReading::with('device')->paginate(50);
    }

    public function store(Request $request, $deviceId)
    {
        $validated = $request->validate([
            'temperature' => 'required|numeric',
            'humidity' => 'required|numeric',
            'battery' => 'nullable|numeric'
        ]);

        $validated['device_id'] = $deviceId;
        return DeviceReading::create($validated);
    }

    public function show($id)
    {
        return DeviceReading::with('device')->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $reading = DeviceReading::findOrFail($id);
        $validated = $request->validate([
            'temperature' => 'sometimes|numeric',
            'humidity' => 'sometimes|numeric',
            'battery' => 'nullable|numeric'
        ]);

        $reading->update($validated);
        return $reading;
    }

    public function destroy($id)
    {
        DeviceReading::findOrFail($id)->delete();
        return response(null, 204);
    }
}