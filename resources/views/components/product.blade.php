<div class="card">
<div class="card-header">
        <h3 class="card-title"> <i class="fas fa-list"></i> LIST OF PRODUCTS</h3>
        <div class="card-tools">
            <div class="input-group form-inline input-group-sm" style="width: 100%;">
                <p class="form-inline">
                    @isset(auth()->user()->role->permission['permission']['product']['list'])
                    <a href="@route('product.index')" class="btn btn-info text-light"><i class="fas fa-list"></i>
                        LIST OF PRODUCTS</a>
                    @endisset
                    @isset(auth()->user()->role->permission['permission']['product']['add'])
                    <a href="@route('product.create')" class="btn btn-primary"><i class="fas fa-plus"></i> ADD NEW PRODUCTS</a>
                    @endisset
                </p>
            </div>
        </div>
    </div>
</div>
