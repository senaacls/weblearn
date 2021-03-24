<div wire:ignore.self class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Edit Barang</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                     <span aria-hidden="true close-btn">×</span>
                </button>
            </div>
           <div class="modal-body">
                <form>
                    <div class="form-group">
                        <label>Nama Barang</label>
                        <input type="text" class="form-control" id="name" wire:model="name">
                        @error('name') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>Foto Barang</label>
                        <input type="file" class="form-control" id="foto" wire:model="foto" accept="image/x-png,image/jpg,image/jpeg">
                        @error('foto') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>Harga Jual </label>
                        <input type="text" class="form-control text-right" id="hargajual" wire:model="hargajual" placeholder="0">
                        @error('hargajual') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>Harga Beli </label>
                        <input type="text" class="form-control text-right" id="hargabeli" wire:model="hargabeli" placeholder="0">
                        @error('hargabeli') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                    <div class="form-group">
                        <label>Stok </label>
                        <input type="number" class="form-control text-right" id="stok" wire:model="stok" placeholder="0">
                        @error('stok') <span class="text-danger error">{{ $message }}</span>@enderror
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-warning close-btn" wire:click.prevent="cancel()" data-dismiss="modal">Cancel</button>
                <button type="button" wire:click.prevent="update()" class="btn btn-success close-modal">Save</button>
            </div>
        </div>
    </div>
</div>