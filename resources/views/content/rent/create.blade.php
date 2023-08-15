@extends('layouts/contentNavbarLayout')

@section('title', ' Peminjaman Baru')

@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pages/</span> Peminjaman Baru</h4>

    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
        <!-- Basic with Icons -->
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Administrasi</h5> <small class="text-muted float-end">Merged input group</small>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{route('rent.store')}}">
                        @method('POST')
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Nama Peminjam</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                            class="bx bx-user"></i></span>
                                    <input type="text" class="form-control" readonly id="basic-icon-default-fullname"
                                        placeholder="John Doe" value="{{ Auth::user()->name }}" aria-label="John Doe"
                                        aria-describedby="basic-icon-default-fullname2" />
                                </div>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="exampleFormControlSelect1" class="col-md-2 col-form-label">Mobil</label>
                            <div class="col-md-10">
                                <select id="select2Multiple" class="select2 form-select" name="product_ids[]">
                                    @if (count($products) > 0)
                                      @foreach ($products as $product)
                                        <option value="{{$product->id}}">{{$product->brand}} {{$product->name}} type {{$product->model}}</option>
                                      @endforeach
                                    @else
                                      <option selected>Kosong</option>
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="html5-datetime-local-input" class="col-md-2 col-form-label">Tanggal Ambil</label>
                            <div class="col-md-10">
                                <input class="form-control" type="datetime-local" id="html5-datetime-local-input" name="start_date" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                            <label for="html5-datetime-local-input" class="col-md-2 col-form-label">Tanggal
                                Dikembalikan</label>
                            <div class="col-md-10">
                                <input class="form-control" type="datetime-local" id="html5-datetime-local-input" name="end_date" />
                            </div>
                        </div>
                        <div class="mb-3 row">
                          <div class="col-md-2"></div>
                          <div class="col-md-10">
                            <button type="submit" class="btn btn-primary">Submit</button>
                          </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
  $(document).ready(function() {
    $('.select2').select2()
  })
</script>
@endsection
