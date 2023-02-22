<button type="button" class="btn btn-primary m-2" data-bs-toggle="modal" data-bs-target="#payment">
    Add Payment
</button>

<div class="modal fade" id="payment" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Payment</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="" method="post">
                    <div class="form-floating mb-3 ">
                        <input type="date" class="form-control" id="floatingInput">
                        <label for="floatingInput">Date of payment</label>
                    </div>
                    <div class="form-floating mb-3">
                        <select class="form-select">
                            <option value="" selected>payment type</option>
                            <option value="check">check</option>
                            <option value="cash">cash</option>
                        </select>
                    </div>
                    <div class="form-floating mb-3 ">
                        <input type="number" class="form-control" id="floatingInput">
                        <label for="floatingInput">Amount</label>
                    </div>
                    <div class="form-floating mb-3 ">
                        <input type="text" class="form-control" id="floatingInput">
                        <label for="floatingInput">Notes</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Save</button>
                </form>
            </div>
        </div>
    </div>
</div>