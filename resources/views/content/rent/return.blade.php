@extends('layouts/contentNavbarLayout')

@section('title', ' Pengembalian')

@section('content')
    <h4 class="fw-bold py-3 mb-4"><span class="text-muted fw-light">Pages/</span> Pengembalian Barang</h4>

    <!-- Basic Layout & Basic with Icons -->
    <div class="row">
        <!-- Basic with Icons -->
        <div class="col-xxl">
            <div class="card mb-4">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="mb-0">Administrasi</h5> <small class="text-muted float-end">Merged input group</small>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('rent-return-by-plat') }}">
                        @method('POST')
                        @csrf
                        <div class="row mb-3">
                            <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Plat Nomor</label>
                            <div class="col-sm-10">
                                <div class="input-group input-group-merge">
                                    {{-- icon gear --}}
                                    <span id="basic-icon-default-fullname2" class="input-group-text"><i
                                            class="bx bx-user"></i></span>
                                    <input type="text" class="form-control" id="basic-icon-default-fullname"
                                        placeholder="Tulis Seperti DK 1103 NT" value="" aria-label="plat_number"
                                        aria-describedby="basic-icon-default-fullname2" name="plat_number" />
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-10">
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
