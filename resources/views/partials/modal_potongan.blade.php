<div class="modal fade" id="modal-potongan" tabindex="-1" role="dialog" aria-labelledby="modal_potongan" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modal_potongan">Atur Potongan Saldo Cuti</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="" id="action-id-potongan" method="POST" class="d-inline">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="potongan">Saldo Cuti Terpotong</label>
                        <input type="number" name="potongan" id="potongan" class="form-control">
                        <p class="form-text text-muted">
                            Jumlah saldo cuti yang akan ditarik dari saldo cuti anda.
                        </p>
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
    

@push('after-scripts')
    <script>
        function potongan(url, potongan){

            $('#modal-potongan').modal();

            // set potongan
            $('#potongan').val(potongan);
            let potonganForm = document.getElementById("action-id-potongan");
            potonganForm.setAttribute("action", url)
        }
    </script>
@endpush