<div class="modal fade" id="modal-form" tabindex="-1" role="dialog" aria-labelledby="modal-form" aria-hidden="true">
    <div class="modal-dialog modal- modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
            <div class="modal-body p-0">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-header bg-transparent pb-3 font-weight-bold">
                        <div class="text-muted text-center mt-2 mb-3" id="user-name"><small></small></div>
                        <div class="btn-wrapper text-center" id="user-balance">
                        </div>
                    </div>
                    <div class="card-body px-lg-5 py-lg-5">
                        <form role="form" method="POST" action="{{ route(\App\Http\Controllers\Api\TransactionController::ROUTE_WITHDRAW) }}">
                            @csrf
                            @method('post')
                            <div class="form-group mb-3">
                                <label for="user-amount">Amount, USD</label>
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-money-coins"></i></span>
                                    </div>
                                    <input name="user-amount" id="user-amount" class="form-control" type="text">
                                    <input name="user-id" id="user-id" class="form-control" type="hidden">
                                </div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-creatory my-4">Withdraw</button>
                                <button type="button" class="btn btn-neutral  ml-auto" data-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    document.addEventListener('DOMContentLoaded', () => {
        const inputElement = document.getElementById('user-amount')
        const maskOptions = {
            mask: Number,
            thousandsSeparator: ' '
        }
        IMask(inputElement, maskOptions);
    })
</script>
