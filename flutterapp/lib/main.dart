import 'package:flutter/material.dart';
import 'package:http/http.dart' as http;
import 'dart:convert';

void main() {
  runApp(const MyApp());
}

// Device and Reading models (add these ABOVE MyApp class)
class Device {
  final int id;
  final String name;
  final String? location;
  final String deviceId;
  final String? description;
  final List<Reading>? readings;

  Device({
    required this.id,
    required this.name,
    this.location,
    required this.deviceId,
    this.description,
    this.readings,
  });

  factory Device.fromJson(Map<String, dynamic> json) {
    return Device(
      id: json['id'],
      name: json['name'],
      location: json['location'],
      deviceId: json['device_id'],
      description: json['description'],
      readings:
          json['readings'] != null
              ? (json['readings'] as List)
                  .map((reading) => Reading.fromJson(reading))
                  .toList()
              : null,
    );
  }
}

class Reading {
  final int id;
  final int deviceId;
  final String temperature;
  final String humidity;
  final String? battery;
  final String recordedAt;

  Reading({
    required this.id,
    required this.deviceId,
    required this.temperature,
    required this.humidity,
    this.battery,
    required this.recordedAt,
  });

  factory Reading.fromJson(Map<String, dynamic> json) {
    return Reading(
      id: json['id'],
      deviceId: json['device_id'],
      temperature: json['temperature'],
      humidity: json['humidity'],
      battery: json['battery'],
      recordedAt: json['recorded_at'],
    );
  }
}

// Rest of the main.dart content (MyApp and DeviceListScreen)
class MyApp extends StatelessWidget {
  const MyApp({super.key});

  @override
  Widget build(BuildContext context) {
    return MaterialApp(
      title: 'Device List',
      theme: ThemeData(
        colorScheme: ColorScheme.fromSeed(seedColor: Colors.deepPurple),
      ),
      home: const DeviceListScreen(),
    );
  }
}

class DeviceListScreen extends StatefulWidget {
  const DeviceListScreen({super.key});

  @override
  State<DeviceListScreen> createState() => _DeviceListScreenState();
}

class _DeviceListScreenState extends State<DeviceListScreen> {
  List<Device> devices = [];
  bool isLoading = true;
  String errorMessage = '';

  @override
  void initState() {
    super.initState();
    fetchDevices();
  }

  Future<void> fetchDevices() async {
    try {
      final response = await http.get(
        Uri.parse('http://192.168.0.100:8000/api/devices'),
        headers: {'Accept': 'application/json'},
      );

      if (response.statusCode == 200) {
        final Map<String, dynamic> responseData = json.decode(response.body);
        final List<dynamic> deviceData = responseData['data'];

        setState(() {
          devices = deviceData.map((json) => Device.fromJson(json)).toList();
          isLoading = false;
        });
      } else {
        setState(() {
          errorMessage = 'Failed to load devices: ${response.statusCode}';
          isLoading = false;
        });
      }
    } catch (e) {
      setState(() {
        errorMessage = 'Error: ${e.toString()}';
        isLoading = false;
      });
    }
  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      appBar: AppBar(
        title: const Text('Device List'),
        actions: [
          IconButton(icon: const Icon(Icons.refresh), onPressed: fetchDevices),
        ],
      ),
      body:
          isLoading
              ? const Center(child: CircularProgressIndicator())
              : errorMessage.isNotEmpty
              ? Center(child: Text(errorMessage))
              : devices.isEmpty
              ? const Center(child: Text('No devices found'))
              : ListView.builder(
                itemCount: devices.length,
                itemBuilder: (context, index) {
                  final device = devices[index];
                  return Card(
                    margin: const EdgeInsets.all(8),
                    child: ExpansionTile(
                      title: Text(device.name),
                      subtitle: Text(device.deviceId),
                      children: [
                        if (device.location != null)
                          ListTile(
                            leading: Icon(Icons.location_on),
                            title: Text('Location'),
                            subtitle: Text(device.location!),
                          ),
                        if (device.readings != null &&
                            device.readings!.isNotEmpty)
                          ...device.readings!
                              .map(
                                (reading) => ListTile(
                                  title: Text(
                                    '${reading.temperature}°C / ${reading.humidity}%',
                                  ),
                                  subtitle: Text(
                                    'Recorded at: ${reading.recordedAt}',
                                  ),
                                ),
                              )
                              .toList(),
                      ],
                    ),
                  );
                },
              ),
      floatingActionButton: FloatingActionButton(
        onPressed: fetchDevices,
        tooltip: 'Refresh',
        child: const Icon(Icons.refresh),
      ),
    );
  }
}
