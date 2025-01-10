<?php

namespace App\Http\Controllers;

use App\Models\Santri;
use Illuminate\Http\Request;

class SantriController extends Controller
{
    public function index(Request $request)
    {
        $showEntries = $request->input('show_entries', 10);
        $santries = Santri::latest()->orderBy('name')->filter(request(['search']))
            ->paginate($showEntries)->withQueryString();


        return view('Dashboard.Santri.index', [
            'title' => 'Data Alumni',
            'santries' => $santries,
        ]);
    }
}