<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;
use Illuminate\Contracts\View\View;
use App\Models\Customer;

class CustomerExport implements FromView, WithEvents
{
    /**
     * @return View
     */
    public function view(): View
    {
        $data = Customer::select([
            'Username',
            'Email',
            'Wa',
            'Bank',
            'NamaRek',
            'NoRek',
            'id'
        ])
        ->orderBy('id', 'desc')
        ->limit(10);

        $customer = $data->get();

        return view('excel.customer', [
            'customer' => $customer,
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
