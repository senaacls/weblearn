<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\BarangModel;
use Livewire\WithFileUploads;

class Barang extends Component
{
    use WithPagination;
    use WithFileUploads;

    public $kode, $name, $foto, $hargajual, $hargabeli, $stok;
    public $filter;
    protected $listeners = ['destroy'];
    public $updateMode = false;

    public function render()
    {
        $filter = '%'.$this->filter.'%';
        return view('livewire.barang',[
            'barangs' => BarangModel::where('id','like', $filter)->orWhere('NamaBarang', 'like', $filter)
                        ->select('barangs.id as kode', 'NamaBarang', 'FotoBarang', 'HargaJual', 'HargaBeli', 'Stok')
                        ->paginate(5)
        ]);
    }

    public function store()
    {
        $this->validate([
            'name' => 'required|string|unique:barangs,id,' . $this->name,
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:100',
            'hargajual' => 'required|numeric',
            'hargabeli' => 'required|numeric',
            'stok' => 'required|numeric'
        ]);
        $fotoname = md5($this->foto . microtime()).'.'.$this->foto->extension();
        $this->foto->storeAs('photos', $fotoname);

        BarangModel::create([
            'NamaBarang' => $this->name,
            'FotoBarang' => $fotoname,
            'HargaJual' => $this->hargajual,
            'HargaBeli' => $this->hargabeli,
            'Stok' => $this->stok
        ]);

        session()->flash('message', 'Barang berhasil ditambahkan');

        $this->resetFields();
        $this->emit('barangStore');
    }

    public function resetFields()
    {
        $this->kode = '';
        $this->name = '';
        $this->foto = '';
        $this->hargajual = '';
        $this->hargabeli = '';
        $this->stok = '';
    }



    public function showConfirmation($id)
    { 
        $this->emit("swal:confirm", [
            'type'        => 'warning',
            'title'       => 'Are you sure?',
            'text'        => "You won't be able to revert this!",
            'confirmText' => 'Yes, delete!',
            'method'      => 'appointments:delete',
            'kode'        => $id
        ]);
    }

    public function destroy($kode)
    {
        $barang = BarangModel::find($kode);
        $barang->delete();
        session()->flash('message', 'Barang '.$barang->NamaBarang. ' berhasil dihapus');
    }

    public function edit($kode)
    {
        $this->updateMode = true;
        $barang = BarangModel::select('barangs.id as kode', 'NamaBarang', 'FotoBarang', 'HargaJual', 'HargaBeli', 'Stok')->where('id',$kode)->first();
        $this->kode = $barang->kode;
        $this->name = $barang->NamaBarang;
        $this->hargajual = $barang->HargaJual;
        $this->hargabeli = $barang->HargaBeli;
        $this->stok = $barang->Stok;
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetFields();
    }

    public function update()
    {
        $this->validate([
            'name' => 'required|string|unique:barangs,id,' . $this->name,
            'foto' => 'required|image|mimes:jpeg,png,jpg|max:100',
            'hargajual' => 'required|numeric',
            'hargabeli' => 'required|numeric',
            'stok' => 'required|numeric'
        ]);

        $fotoname = md5($this->foto . microtime()).'.'.$this->foto->extension();
    
        if ($this->kode) {
            $this->foto->storeAs('photos', $fotoname);
            $barang = BarangModel::find($this->kode);
            $barang->update([
                'NamaBarang' => $this->name,
                'FotoBarang' => $fotoname,
                'HargaJual' => $this->hargajual,
                'HargaBeli' => $this->hargabeli,
                'Stok' => $this->stok
            ]);
            $this->updateMode = false;
            session()->flash('message', 'Barang updated successfully.');
            $this->resetFields();
            $this->emit('barangUpdate');
        }
    }

}
