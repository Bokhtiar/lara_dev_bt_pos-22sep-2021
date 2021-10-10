<div class="card">
<div class="card-header">
        <h3 class="card-title"> <i class="fas fa-list"></i> LIST OF ORDER</h3>
        <div class="card-tools">
            <div class="input-group form-inline input-group-sm" style="width: 100%;">
                <p class="form-inline">
                    @isset(auth()->user()->role->permission['permission']['sell']['list'])
                    <a href="@route('order.index')" class="btn btn-info text-light"><i class="fas fa-list"></i>
                        List Of SELL</a>
                    @endisset
                    @isset(auth()->user()->role->permission['permission']['sell']['add'])
                    <a href="@route('sell.create')" class="btn btn-primary"><i class="fas fa-plus"></i> SELL CREATE</a>
                    @endisset
                </p>
            </div>
        </div>
    </div>
</div>
