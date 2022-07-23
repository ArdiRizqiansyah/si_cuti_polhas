<div class="modal fade" id="modal-setujui" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header border-0 flex-column pb-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <p class="mb-0">
                    <i class="bi bi-check2-circle fs-2 text-success"></i>
                </p>
                <h5 class="modal-title" id="deleteModalLabel">Permohonan Pegawai</h5>
            </div>
            <div class="modal-body">
                <div class="row text-center">
                    <div class="col">
                        <p>Apakah anda ingin mensetujui permohonan pegawai?</p>
                        <div class="my-4">
                            <button type="button" class="btn btn-secondary me-1" data-bs-dismiss="modal">Batal</button>
                            <form action="" id="action-id-setujui" method="POST" class="d-inline">
                                <input type="hidden" name="permohonan" id="permohonan-modal">
                                
                                @method('put')
                                @csrf
                                <button class="btn btn-danger ms-1" onclick="menolak()">Tolak</button>
                                <button class="btn btn-success ms-1" onclick="mensetujui()">Setujui</button>
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
        function setujui(url){

            $('#modal-setujui').modal();

            let setujuiForm = document.getElementById("action-id-setujui");
            setujuiForm.setAttribute("action", url)
        }

        function mensetujui(){
            $('#permohonan-modal').val('setuju');
        }

        function menolak(){
            $('#permohonan-modal').val('tolak');
        }
    </script>
@endpush