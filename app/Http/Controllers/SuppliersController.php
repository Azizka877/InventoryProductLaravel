<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SuppliersController extends Controller
{
    public function index(Request $request)
    {
        $query = Supplier::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        // Récupérer tous les fournisseurs avec pagination
        $suppliers = Supplier::paginate(5);

        return view('suppliers.index', compact('suppliers'));
    }
}
