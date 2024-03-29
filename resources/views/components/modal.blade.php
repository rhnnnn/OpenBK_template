<div class="modal fade" id="{{$id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="{{$idTitle}}" aria-hidden="true">
  <div class="modal-dialog">
      <div class="modal-content">
          <div class="modal-header {{$classHeader}}">
              <h5 class="modal-title" id="{{$idTitle}}">{{$title}}</h5>
              {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="color: white;"></button> --}}
              <button type="button" class="btn" data-bs-dismiss="modal" aria-label="Close"><i class="fa-solid fa-xmark"></i></button>
          </div>
          <form method="post" action="{{$formAction}}" enctype="multipart/form-data">
              @csrf
              @method($method)
              <div class="modal-body">
                  {{$slot}}
              </div>
              <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-primary">Okay</button>
              </div>
          </form>
      </div>
  </div>
</div>
