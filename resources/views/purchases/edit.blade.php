
<div class="box-content">
    <div class="box box-primary box-search">
        <div class="box-header with-border">
            <h1 class="box-title">Editar Compra</h1>
        </div>
    </div>
    <div class="box box-container">
        <div class="box-body">
            <div class="row">
                <form id="formPurchase" data-url="{{route('purchases.update',['id'=>':ID'])}}" method="POST">
                    @component('purchases/form')
                        @slot('products',$products)
                        @slot('action','update')
                    @endcomponent
                </form>
            </div>
        </div>
    </div>
</div>