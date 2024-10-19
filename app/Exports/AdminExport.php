<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Contracts\View\View;
use App\Models\User;

class AdminExport implements FromView, WithEvents
{
    /**
     * @return View
     */
    public function view(): View
    {
        $data = User::select([
            'name',
            'email',
            'id'
        ])
        ->orderBy('id', 'desc')
        ->limit(100);

        $admin = $data->get();

        return view('excel.admin', [
            'admin' => $admin,
        ]);
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {

                foreach (range('A', 'F') as $columnID) {
                    $event->sheet->getDelegate()->getColumnDimension($columnID)->setAutoSize(true);
                }
            },
        ];
    }
}
