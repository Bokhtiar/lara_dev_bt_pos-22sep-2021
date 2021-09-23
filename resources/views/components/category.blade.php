<div>
    <div class="input-group form-inline input-group-sm" style="width: 100%;">
        <p class="form-inline">
        <a href="@route('category.index')" class="btn btn-info text-light"><i class="fas fa-list"></i> List Of Categories</a>
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal" data-bs-whatever="@mdo"><i class="fas fa-plus"></i> Add Category</button>
            </p>
    </div>

    <div class="modal fade" id="exampleModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">NEW CATEGORY CREATE </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form action="@route('category.store')" method="POST">
        @csrf
      <div class="modal-body">
          <div class="mb-3">
            <label for="category-name" class="col-form-label">Category Name: <span class="text-danger">*</span></label>
            <input type="text" name="category_name" placeholder=" type here category name" class="form-control" maxlength="30" minlength="2" id="category-name" required>
          </div>
          <div class="mb-3">
            <label for="message-text" class="col-form-label">Description:</label>
            <textarea class="form-control" name="category_description" placeholder="type here category description" id="message-text"></textarea>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="far fa-times-circle"></i> Close</button>
        <button type="submit" class="btn btn-primary"><i class="fas fa-share-square"></i> Create New Category</button>
      </div>
      </form>
    </div>
  </div>
</div>



</div>
