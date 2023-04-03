        <style>
            .modal {
              padding: 0 !important; // override inline padding-right added from js
            }
            .modal .modal-dialog {
              width: 100%;
              max-width: none;
              height: 100%;
              margin: 0;
            }
            .modal .modal-content {
              height: 100%;
              border: 0;
              border-radius: 0;
            }
            .modal .modal-body {
              overflow-y: auto;
            }
        </style>
        
            <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#exampleModal">
              Topup
            </button>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-body">
                <iframe src="payment" frameborder="0" style="position: relative; height: 99%; width: 100%;" title="description"></iframe>


              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
              </div>
            </div>
          </div>
        </div>
        <style>
        </style>