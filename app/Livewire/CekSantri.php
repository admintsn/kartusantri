<?php

namespace App\Livewire;

use App\Models\Santri;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Filament\Infolists\Components\TextEntry;
use Filament\Infolists\Infolist;
use Filament\Tables\Columns\Layout\Stack;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Table;
use Illuminate\Validation\ValidationException;
use Livewire\Component;

class CekSantri extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public $ceknism = '';

    public function ceknismsantri()
    {
        $ceknism = Santri::where('nism', $this->ceknism)->whereHas('statussantri', function ($query) {
            $query->where('stat_santri_id', 3);
        })
        ->count();

        if ($ceknism == 0) {
            throw ValidationException::withMessages([
                'ceknism' => trans('auth.failed'),
            ]);
        }
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(Santri::where('nism', $this->ceknism))
            ->columns([
                Stack::make([

                    TextColumn::make('nism')
                        ->label('NISM')
                        ->grow(false)
                        ->description(fn($record): string => "NISM:", position: 'above'),

                    TextColumn::make('nama_lengkap')
                        ->label('Nama')
                        ->grow(false)
                        ->description(fn($record): string => "Nama:", position: 'above'),


                ])

            ])
            ->actions([])
            ->paginated(false)
            ->emptyStateHeading('Klik Tombol CEK');
    }
    
    public function render()
    {

        $data = Santri::where('nism', $this->ceknism);

        return view('livewire.cek-santri', [
            'data' => $data,
        ]);
    }
}
