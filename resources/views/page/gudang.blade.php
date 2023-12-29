@extends('mainpage.index')
@section('content')
<div class="page-wrapper">
	<div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        	<div class="breadcrumb-title pe-3">Data Master Gudang</div>
        	<div class="ms-auto">
                <div class="ps-3">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb mb-0 p-0">
                            <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                            </li>
                            <li class="breadcrumb-item active" aria-current="page">Gudang</li>
                        </ol>
                    </nav>
                </div>
        	</div>
        </div>
		<!--end breadcrumb-->
        <div class="card">
        	<div class="card-body">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#Modal"><i class='bx bx-list-plus'></i>Tambah Data</button>
                <br><br>
                <div class="table-responsive">
        			<table id="gudang-table" class="table table-striped table-bordered" style="width:100%">
                        <thead>
                            <tr>
                                <th>No.</th>
                                <th>Kode Gudang</th>
                                <th>Nama Gudang</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
        			</table>
        		</div>
        	</div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="Modal" tabindex="-1" aria-labelledby="ModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg modal-dialog-centered">
        		<div class="modal-content">
        			<div class="modal-header">
        				<h5 class="modal-title" id="ModalLabel">Input Master Gudang</h5>
        				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        			</div>
        			<div class="modal-body">
                    <form role="form">
                    <input type="hidden" name="id" id="id">
                        <div class="row mb-3">
                            <label for="input-data" class="col-sm-3 col-form-label">Kode Gudang</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="kode_gudang" placeholder="Kode Gudang">
                        </div>
						</div>
                        <div class="row mb-3">
                            <label for="input-data" class="col-sm-3 col-form-label">Nama Gudang</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nama_gudang" placeholder="Nama Gudang">
                            </div>
                        </div>
                    </form>
                    </div>
        			<div class="modal-footer">
        				<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        				<button type="button" class="btn btn-primary" onclick="save()">Save</button>
        			</div>
        		</div>
        	</div>
        </div>


    </div>
</div>
@endsection

@push('scripts')
<script src="assets/script/gudang.js"></script>
@endpush