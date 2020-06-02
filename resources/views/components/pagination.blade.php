<div class="col-md-8">
    {{ $pagination }}
</div>
<div class="col-md-2 col-page">
    <div class="form-group">
        <label>Total:</label>
        <input class="form-control" readonly value="{{ $total }}">
    </div>
</div>
<div class="col-md-2">
    <div class="form-group">
        <label>Registros:</label>
        <select class="form-control" id="per-page">
            <option>15</option>
            <option>25</option>
            <option>50</option>
            <option>100</option>
            <option>200</option>
        </select>
    </div>
</div>