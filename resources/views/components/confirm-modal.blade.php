<div class="modal blur fade" id="modal-confirm" tabindex="-1">
    <div class="modal-dialog">
      <div class="modal-content">
        <form id="confirm-form" method="POST" action="#" autocomplete="off">  
              @csrf
              @method('DELETE') 
              <div class="modal-header">
                  <h5 class="modal-title">Confirm Action</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                  <p>Are you sure you want to continue?</p>
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-danger">Confirm</button>
              </div>
          </form>
      </div>
    </div>
</div>
