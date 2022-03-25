<div>
    @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif
    <div class="row">
        <div class="col-md-6 overflow-auto">
            <div class="row">
                @foreach ($foods as $food)
                    <div class="col-md-6">
                        <div class="card">
                            <img src="{{ asset('storage/foods/' . $food->image) }}" class="card-img-top" style="width: 100%; height: 180px">
                            <div class="card-body">
                            <h5 class="card-title">{{ $food->name }}</h5>
                            <p class="card-text" id="price">Rp {{ number_format($food->price) }}</p>
                            {{-- <input type="hidden" wire:model="itemPrice" value="{{ $food->price }}"> --}}
                            <button type="button" id="tambah"  wire:click="addItem({{ $food->price }},{{ $food->id }})" class="btn btn-primary">Tambah</button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-6">
            <div class="card">
                <div class="card-header font-weight-bold">Tambah Pesanan</div>
                    <div class="card-body">
                        <form wire:submit.prevent="order">
                            @csrf
                            <div class="form-group mb-3">
                                <label for="customer_name" class="form-label font-weight-bold">Nama Pelanggan</label>
                                <input type="text" name="customer_name" wire:model="customerName" id="customer_name" value="{{ old('customer_name') }}" class="form-control @error('customerName') is-invalid @elseif($customerName != '') is-valid @enderror">
                                @error('customerName')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="description" class="form-label font-weight-bold">Deskripsi Pesanan</label>
                                <input type="text" name="description" wire:model="description" id="description" value="{{ old('description') }}" class="form-control @error('description') is-invalid @elseif($description != '') is-valid @enderror">
                                @error('description')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="table_id" class="form-label font-weight-bold">Meja</label>
                                <select name="table_id" wire:model="tableId" class="form-control @error('tableId') is-invalid @elseif($tableId != '') is-valid @enderror" id="table_id">
                                    @if ($tables->count() !== 0)
                                    <option value="" selected>Pilih Meja</option>
                                    @else
                                    <option value="" selected>Semua Meja Penuh!</option>
                                    @endif
                                    @foreach ($tables as $table)
                                        <option value="{{ $table->id }}">{{ $table->table_number }}</option>
                                    @endforeach
                                </select>
                                @error('tableId')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <label for="totalPrice" class="form-label font-weight-bold">Total Harga</label>
                                <input type="number" name="totalPrice @error('totalPrice') is-invalid @elseif($totalPrice !== 0) is-valid  @enderror" wire:model="totalPrice" id="totalPrice" class="form-control">
                                @error('totalPrice')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-3">
                                <button type="submit" class="btn btn-primary float-right" {{ $isDisabled }}>Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
