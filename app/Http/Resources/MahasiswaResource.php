<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class MahasiswaResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'id'            => $this->id,
            'nim'           => $this->nim,
            'nama'          => $this->nama,
            'email'         => $this->email,
            'no_hp'         => $this->no_hp,
            'angkatan'      => $this->angkatan,
            'status'        => $this->status,
            'alamat'        => $this->alamat,
            'program_studi' => [
                'id'       => $this->programStudi->id,
                'nama'     => $this->programStudi->nama,
                'jenjang'  => $this->programStudi->jenjang,
                'fakultas' => $this->programStudi->fakultas,
            ],
            'created_at' => $this->created_at->toDateTimeString(),
            'updated_at' => $this->updated_at->toDateTimeString(),
        ];
    }
}
