<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class UserExport implements FromCollection,WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return User::orderby('created_at', 'desc')->get();
    }

    private $rowNumber = 1;
    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'Email',
            'Peran',
            'Created At',
        ];
    }

    public function map($user): array
    {
        return [
            $this->rowNumber++,
            $user->dataSiswa->nama,
            $user->email,
            $user->role,
            \Carbon\Carbon::parse($user->created_at)->locale('id')->isoFormat('dddd, D MMMM YYYY'),
        ];
    }

}

