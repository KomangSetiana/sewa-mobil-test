<?php

namespace App\Http\Controllers;

use App\Http\Requests\CarStroreRequest;
use App\Http\Requests\CarUpdateRequest;
use App\Models\Car;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CarController extends Controller
{
    // Halaman daftar mobil
    public function index(Request $request)
    {
        $cars = Car::with('rentals')->filter($request)->get(); // Menggunakan pagination


        return Inertia::render('Cars/Index', [
            'cars' => $cars,
            'filters' => $request->only('search'),
        ]);
    }


    // Halaman tambah mobil baru
    public function create()
    {
        return Inertia::render('Cars/Create');
    }

    // Menyimpan data mobil baru
    public function store(CarStroreRequest $request)
    {;

        Car::create($request->validated());

        return redirect()->route('cars.index')->with('success', 'Car added successfully.');
    }

    // Detail mobil
    public function show($id)
    {
        $car = Car::findOrFail($id);

        return Inertia::render('Cars/Show', [
            'car' => $car,
        ]);
    }

    // Halaman edit mobil
    public function edit($id)
    {
        $car = Car::findOrFail($id);

        return Inertia::render('Cars/Edit', [
            'car' => $car,
        ]);
    }

    // Mengupdate data mobil
    public function update(CarUpdateRequest $request, $id)
    {
        $car = Car::findOrFail($id);

        $car->update($request->validated());

        return redirect()->route('cars.index')->with('success', 'Car updated successfully.');
    }

    // Menghapus data mobil
    public function destroy($id)
    {
        $car = Car::findOrFail($id);
        $car->delete();

        return redirect()->route('cars.index')->with('success', 'Car deleted successfully.');
    }
}
