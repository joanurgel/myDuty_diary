<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addModal">New Documentation</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="{{route('documentations.store')}}" method="POST" enctype="multipart/form-data">  
                @csrf

            <div class="modal-body mt-3">
                <div class="row">
                    <div class="col-12">
                        <input type="file" name="doc_img" id="doc_img">
                    </div>
                    <div class="col-12 mt-3">
                        <!-- Applying full width -->
                        <input type="text" name="caption" placeholder="Enter a caption" value="" required class="form-control w-100">
                    </div>
                </div>
            </div>
            
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <input type="submit" class="btn btn-primary" value="Save">
            </div>
            </form>
        </div>
    </div>
</div>
