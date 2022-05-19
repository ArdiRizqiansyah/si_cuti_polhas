<div class="modal fade" id="modal-delete" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 flex-column pb-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <p class="mb-0">
                    <i class="bi bi-trash-fill text-danger fs-2"></i>
                </p>
                <h5 class="modal-title" id="deleteModalLabel">Hapus Data</h5>
            </div>
            <div class="modal-body">
                <div class="row text-center">
                    <div class="col">
                        <p>Apakah anda yakin ingin menghapus data? proses tidak dapat dikembalikan.</p>
                        <div class="my-4">
                            <button type="button" class="btn btn-secondary me-1" data-bs-dismiss="modal">Batal</button>
                            <form action="" id="action-id-hapus" method="POST" class="d-inline">
                                @method('delete')
                                @csrf
                                <button class="btn btn-danger btn-hapus-data ms-1">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('after-scripts')
    <script>
        function hapusData(url){

            $('#modal-delete').modal();

            let hapusForm = document.getElementById("action-id-hapus");
            hapusForm.setAttribute("action", url)
        }
    </script>
@endpush