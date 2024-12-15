<?php

namespace App\Http\Controllers;

use App\Models\Report;
use App\Models\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReportController extends Controller
{
    public function index()
    {
        $reports = Report::all();
        return view('report.index', compact('reports'));
    }

    public function page()
    {
        $reports = Report::all();
        return view('pages.report', compact('reports'));
    }

    public function dashboard()
    {
        $reports = Report::all();
        return view('staff.dashboard', compact('reports'));
    }

    public function create()
    {
        return view('report.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'province' => 'required',
            'regency' => 'required',
            'subdistrict' => 'required',
            'village' => 'required',
            'type' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|max:2048',
        ]);

        $provinceName = file_get_contents("https://www.emsifa.com/api-wilayah-indonesia/api/province/{$request->province}.json");
        $regencyName = file_get_contents("https://www.emsifa.com/api-wilayah-indonesia/api/regency/{$request->regency}.json");
        $subdistrictName = file_get_contents("https://www.emsifa.com/api-wilayah-indonesia/api/district/{$request->subdistrict}.json");
        $villageName = file_get_contents("https://www.emsifa.com/api-wilayah-indonesia/api/village/{$request->village}.json");

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('reports', 'public');
        }

        Report::create([
            'user_id' => Auth::id(),
            'province' => json_decode($provinceName)->name,
            'regency' => json_decode($regencyName)->name,
            'subdistrict' => json_decode($subdistrictName)->name,
            'village' => json_decode($villageName)->name,
            'type' => $request->type,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('report.index')->with('success', 'Pengaduan berhasil dibuat!');
    }

    public function show($id)
    {
        // Ambil laporan berdasarkan ID dengan relasi komentar
        $report = Report::with('comments')->findOrFail($id);

        // Kirim data laporan ke view
        return view('pages.comment', compact('report'));
    }

    public function edit(Report $report) {}

    public function update(Request $request, Report $report) {}

    public function destroy(Report $report) {}

    public function search(Request $request)
    {
        $provinceName = $request->query('province_name');
        $reports = Report::where('province', $provinceName)->with('user')->get();
        return response()->json($reports);
    }


    public function vote($id)
    {
        $report = Report::findOrFail($id);

        $report->votes += 1;
        $report->save();

        return redirect()->back()->with('success', 'Vote berhasil ditambahkan!');
    }

    public function action(Request $request)
    {

        $request->validate([
            'response' => 'required|string',
            'report_id' => 'required|exists:reports,id',
        ]);


        $report = Report::find($request->report_id);

   
        if ($request->response == 'Tolak') {
            $report->delete();

            return redirect()->route('staff.dashboard')->with('success', 'Laporan telah ditolak dan dihapus.');
        }

        if ($request->response == 'Proses Penyelesaian/Perbaikan') {
            return view('staff.report')->with('success', 'Laporan sedang diproses untuk penyelesaian.');
        }

        return redirect()->route('staff.dashboard')->with('error', 'Tanggapan tidak valid.');
    }
}
