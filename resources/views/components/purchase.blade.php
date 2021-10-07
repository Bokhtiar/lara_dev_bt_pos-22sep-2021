<div class="card">
<div class="card-header">
        <h3 class="card-title"> <i class="fas fa-list"></i> LIST OF PURCHASE</h3>
        <div class="card-tools">
            <div class="input-group form-inline input-group-sm" style="width: 100%;">
                <p class="form-inline">
                    @isset(auth()->user()->role->permission['permission']['purchase']['list'])
                    <a href="@route('purchase.index')" class="btn btn-info text-light"><i class="fas fa-list"></i>
                        List Of PURCHASE</a>
                    @endisset
                    @isset(auth()->user()->role->permission['permission']['purchase']['add'])
                    <a href="@route('purchase.create')" class="btn btn-primary"><i class="fas fa-plus"></i> ADD NEW PURCHASE</a>
                    @endisset
                </p>
            </div>
        </div>
    </div>
</div>
