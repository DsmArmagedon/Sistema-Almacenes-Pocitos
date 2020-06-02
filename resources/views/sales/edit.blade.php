<div class="box-content">
    <div class="box box-primary box-search">
        <div class="box-header with-border">
            <h1 class="box-title">Editar Venta</h1>
        </div>
    </div>
    <div class="box box-container">
        <div class="box-body">
            <div class="row">
                <form id="formSale" data-url="{{route('sales.update',['id'=>':ID'])}}" method="POST">
                    @component('sales/form')
                        @slot('products',$products)
                        @slot('action','update')
                    @endcomponent
                </form>
            </div>
        </div>
    </div>
</div>