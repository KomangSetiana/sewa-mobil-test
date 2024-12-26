<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Rental;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Inertia;

use function Laravel\Prompts\alert;

class RentalController extends Controller
{
    // Halaman daftar semua penyewaan
    public function index()
    {
        $rentals = Rental::with(['car', 'user'])->paginate(10);

        return Inertia::render('Rentals/Index', [
            'rentals' => $rentals,
        ]);
    }

    // Form untuk menyewa mobil
    public function create($id)
    {
        $car = Car::findOrFail($id);

        if ($car->is_available === 0) {
            return alert('Mobil tidak tersedia');
        }

        return Inertia::render('Rentals/Create', [
            'car' => $car,
        ]);
    }

    // Menyimpan data penyewaan
    public function store(Request $request, $id)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        $car = Car::findOrFail($id);

        if (!$car->is_available) {
            return back()->with('error', 'Car not available');
        }

        $total_days = Carbon::parse($request->start_date)->diffInDays(Carbon::parse($request->end_date));
        $total_cost = $total_days * $car->daily_rate;

        $rental = Rental::create([
            'user_id' => auth()->id(),
            'car_id' => $car->id,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
            'total_days' => $total_days,
            'total_cost' => $total_cost,
        ]);

        $car->update(['is_available' => false]);

        return redirect()->route('rentals.index')->with('success', 'Rental created successfully.');
    }

    // Mengembalikan mobil
    public function returnCar($id)
    {
        $rental = Rental::findOrFail($id);

        if ($rental->status !== 'active') {
            return back()->with('error', 'Rental already returned');
        }

        $rental->update(['status' => 'returned']);
        $rental->car->update(['is_available' => true]);

        return redirect()->route('rentals.index')->with('success', 'Car returned successfully.');
    }
}
