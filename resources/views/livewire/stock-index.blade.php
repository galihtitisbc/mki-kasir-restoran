<div>
    <div class="card-body table-responsive p-0">
        <div class="mbuh col-6 text-center mx-auto my-4">
            <form action="{{ url('/dashboard/stock') }}" method="get">
                <div class="row">
                    <div class="col-9">
                        <h1> {{ $outlet }}</h1>
                        <select wire:model.change="outlet" class="form-control" id="">
                            <option value="" selected>-- Pilih Outlet --</option>
                            @foreach ($outlets as $item)
                                <option value="{{ $item->slug }}"
                                    {{ request('outlet') == $item->slug ? 'selected' : '' }}>{{ $item->outlet_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-3 d-flex">
                        <button type="submit" class="btn btn-primary mr-2">Cari</button>
                        <a href="{{ url('/dashboard/pegawai') }}" type="submit" class="btn btn-danger">Reset</a>
                    </div>
                </div>
            </form>
        </div>
        <table class="table table-hover text-center">
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Kerja Dioutlet</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Posisi</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                {{-- @foreach ($pegawais as $item)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $item->name }}</td>
                            <td>
                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                    data-target="#info-modal{{ $item->user_id }}">
                                    Info
                                </button>
                            </td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->phone }}</td>
                            <td>{{ $item->getRoleNames()->implode(', ') }}</td>
                            <td>
                                <form action="{{ url('/dashboard/pegawai/hapus', $item->user_id) }}" class="form-delete"
                                    method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <a href="{{ url('/dashboard/pegawai/edit', $item->user_id) }}"
                                        class="btn btn-warning">Edit</a>
                                    <button type="submit" class="btn btn-danger delete">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach --}}
            </tbody>
        </table>
    </div>
</div>
