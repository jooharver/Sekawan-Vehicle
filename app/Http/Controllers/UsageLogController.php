<?php

namespace App\Http\Controllers;

use Mpdf\Mpdf;
use App\Models\UsageLog;
use Illuminate\Http\Request;
use App\Exports\UsageLogExport;
use Maatwebsite\Excel\Facades\Excel;

class UsageLogController extends Controller
{
        // Menangani ekspor Excel
    public function exportExcel()
    {
        return Excel::download(new UsageLogExport(), 'usage_data.xlsx');
    }

    public function exportPDF()
    {
        // Ambil data UsageLog beserta data Vehicle yang terhubung
        $reports = UsageLog::with('vehicle')->get();

        // Siapkan HTML untuk PDF
        $html = view('exports.usagelogs_pdf', compact('reports'))->render();

        // Buat instance mPDF dan konversi HTML ke PDF
        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);

        // Unduh file PDF
        $mpdf->Output('Report.pdf', 'D');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UsageLog $usageLog)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UsageLog $usageLog)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UsageLog $usageLog)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UsageLog $usageLog)
    {
        //
    }
}
