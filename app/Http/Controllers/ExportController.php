<?php
namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Facades\Excel;

class ExportController extends Controller
{
    // Excel exporter for anggota
    public function exportAnggotaExcel()
    {
        return Excel::download(new class implements FromCollection, WithHeadings
        {
            public function collection()
            {
                return \App\Models\Anggota::select('id', 'nama', 'alamat', 'tanggal_lahir', 'golongan_id')->get();
            }
            public function headings(): array
            {
                return ['ID', 'Nama', 'Alamat', 'Tanggal Lahir', 'Golongan ID'];
            }
        }, 'anggota.xlsx');
    }

    // PDF exporter for kegiatan (simple list + participants)
    public function exportKegiatanPdf()
    {
        $kegiatans = Kegiatan::with('anggotas')->orderBy('tanggal', 'desc')->get();
        $pdf       = Pdf::loadView('exports.kegiatan_pdf', compact('kegiatans'));
        return $pdf->download('kegiatan.pdf');
    }
}
