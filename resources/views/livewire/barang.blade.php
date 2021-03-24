<x-slot name="header">
    <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Barang') }}
    </h2>
</x-slot>
<div class="py-12">
<div class="max-w-7xl mx-auto sm:px-6 lg:px-6">
<div class="grid grid-cols-3">
  @include('livewire.create')
  <div class="col-span-2"><input type="text" class="form-control object-right my-3" placeholder="Search" wire:model="filter"></div>
</div>
    @if (session()->has('message'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <table class="table table-striped table-borderless text-sm">
        <thead>
            <tr class="bg-danger text-white">
                <th class="px-4 py-2">Kode</th>
                <th class="px-4 py-2">Nama</th>
                <th class="px-4 py-2">Foto</th>
                <th class="px-4 py-2">Harga Jual</th>
                <th class="px-4 py-2">Harga Beli</th>
                <th class="px-4 py-2">Stok</th>
                <th class="px-4 py-2 text-center">Action</th>
            </tr>
        </thead>
        <tbody>
            @forelse($barangs as $barang)
                <tr>
                    <td class="border px-4 py-2">{{ $barang->kode }}</td>
                    <td class="border px-4 py-2">{{ $barang->NamaBarang }}</td>
                    <td class="border px-4 py-2"><a href="/storage/photos/{{ $barang->FotoBarang }}" target="_blank">{{ $barang->FotoBarang }}</a></td>
                    <td class="border px-4 py-2 text-right">{{ $barang->HargaJual }}</td>
                    <td class="border px-4 py-2 text-right">{{ $barang->HargaBeli }}</td>
                    <td class="border px-4 py-2 text-right">{{ $barang->Stok }}</td>
                    <td class="border px-4 py-2 text-center">
                        <button data-toggle="modal" data-target="#updateModal"  wire:click="edit('{{ $barang->kode }}')" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded"><i class="fa fa-pencil"></i> Edit</button>
                        <button wire:click="showConfirmation('{{ $barang->kode }}')" class="bg-red-500 hover:bg-red-700 text-white font-bold py-2 px-4 rounded"><i class="fa fa-trash"></i> Delete</button>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="border px-4 py-2 text-center" colspan="7">Tidak ada data</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{ $barangs->links() }}

    @include('livewire.update')
</div>
</div>