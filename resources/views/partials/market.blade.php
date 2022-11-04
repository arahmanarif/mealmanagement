<div class="col-md-4 m-3">
    <form id="mealMarketStore" method="POST" action="{{ route('meal.market.store') }}" enctype="multipart/form-data">
        @csrf
        <h4 class="mb-4">Add New Market</h4>
        <div class="form-row">
            <div class="form-group col-sm-12">
                <label>Name</label>
                <select name="member_id" class="form-control text-dard rounded-0 bg-transparent" required>

                    <option value=""> >>--Select One--<< </option>
                    @if($all_names->count() > 0)
                        @foreach ($all_names as $all_name)
                            <option value="{{ $all_name->id }}">{{ $all_name->name }}</option>
                        @endforeach
                    @else
                        No Record Found
                    @endif
                </select>
            </div>
            <div class="form-group col-sm-12">
                <label>Amount</label>
                <input type="number" class="form-control rounded-0 bg-transparent" name="amount"
                    placeholder="Amount">
            </div>
            <div class="form-group col-sm-12">
                <label>Form Date</label>
                <input type="date" class="form-control rounded-0 bg-transparent" name="formDate"
                    value="{{ date('Y-m-d') }}" placeholder="Form Date">
            </div>
            <div class="form-group col-sm-12">
                <label>To Date</label>
                <input type="date" class="form-control rounded-0 bg-transparent" name="toDate"
                    placeholder="To Date">
            </div>

            <div class="form-group col-12 mb-0">
                <button type="submit" class="btn btn-primary rounded w-md mt-3">Send</button>
            </div>
        </div>
    </form>
</div>
<div class="col-md-8 table_color rounded p-3">
    <div class="container">
        <div class="row">
            <div class="col-12 table-responsive">
                <table class="table table-bordered market_datatable">
                    <thead>
                        <tr>
                            <th>Serial</th>
                            <th>Name</th>
                            <th>Amount</th>
                            <th>F.Date</th>
                            <th>T.Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody></tbody>
                    <tfoot>
                        <tr>
                            <th colspan="2" style="text-align:right">Total : </th>
                            <th style="text-align:right"> </th>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
