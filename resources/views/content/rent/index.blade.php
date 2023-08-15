@extends('layouts/contentNavbarLayout')

@section('title', 'Tables - Basic Tables')

@section('content')
    <h4 class="fw-bold py-3 mb-4">
        <span class="text-muted fw-light">Pages /</span> Data
    </h4>

    <!-- Basic Bootstrap Table -->
    <div class="card">
        <h5 class="card-header">Barang Dipinjam</h5>
        <div class="table-responsive text-nowrap">
            <table class="table">
                <thead>
                    <tr>
                        <th>Peminjam</th>
                        <th>Bentuk Barang</th>
                        <th>Barang Dipinjam</th>
                        <th>Tanggal Peminjaman</th>
                        <th>Tanggal Pengembalian</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody class="table-border-bottom-0">
                    @foreach ($rents as $index => $rent)
                        <tr>
                            <td>
                                <div class="column">
                                  <div class="col">
                                    <h6>{{ $rent->user->name }}</h6>
                                  </div>
                                  <div class="col">
                                    <h6>{{ $rent->user->email }}</h6>
                                  </div>
                                </div>

                              </td>
                            <td>
                              @foreach ($rent->products as $product)
                                  <img src="{{ asset('storage/'.$product->image) }}" alt="product image" class="img-fluid">
                              @endforeach
                            </td>
                            <td>
                              @foreach ($rent->products as $product)
                                {{-- tag --}}
                                <span class="badge bg-label-primary me-1">{{ $product->brand }} {{ $product->name }} type {{ $product->model }} Nomor Plat - {{ $product->plat_number }}</span>
                              @endforeach
                            </td>
                            <td>
                              {{ $rent->start_date }}
                            </td>
                            <td>
                              {{ $rent->end_date }}
                            </td>
                            <td>
                              @if($rent->status == 'pending')
                                <span class="badge bg-label-warning me-1">Pending</span>
                              @elseif($rent->status == 'accepted')
                                <span class="badge bg-label-success me-1">Accepted</span>
                              @elseif($rent->status == 'rejected')
                                <span class="badge bg-label-danger me-1">Rejected</span>
                              @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="card-footer">
              {{ $rents->links() }}
            </div>
        </div>
    </div>
    <!--/ Basic Bootstrap Table -->
@endsection
