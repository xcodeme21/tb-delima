<?php

namespace App\Exports;

use App\Transaksi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransaksiExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Transaksi::select('tanggal_transaksi', 'no_invoice', 'nama_tujuan', 'no_hp_tujuan', 'alamat_tujuan', 'total_bayar')->get();
    }

    public function headings(): array
    {
        return [
            'Tanggal Transaksi',
            'No. Invoice',
            'Nama',
            'No. HP',
            'Alamat Tujuan',
            'Total Bayar',
        ];
    }
}
