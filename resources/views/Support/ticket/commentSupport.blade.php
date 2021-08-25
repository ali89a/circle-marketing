@php($attachments = json_decode($comment->attachment))

<div class="card {{ $comment->support_id!=''? 'bg-light-1': 'bg-light-5'  }}">
  <!---->
  <!---->
  <div class="card-header email-detail-head">
      <div class="user-details d-flex justify-content-between align-items-center flex-wrap">
          <span class="b-avatar mr-75 badge-secondary rounded-circle"
              style="width: 48px; height: 48px;">
              <span class="b-avatar-img">
                  @if($comment->supportuser->img_url)                                       

                      <img src="{{asset('storage/customer/'.$comment->supportuser->img_url)}}" alt=" No File" class="img-fluid">
                  @endif
              </span>
              <!----></span>
          <div class="mail-items">
              <h5 class="mb-0"> {{$comment->supportuser->name }} </h5>
              <div class="dropdown b-dropdown email-info-dropup btn-group" id="__BVID__1120">
                  <!----><button aria-haspopup="true" aria-expanded="false" type="button"
                      class="btn dropdown-toggle btn-link p-0 dropdown-toggle-no-caret"
                      id="__BVID__1120__BV_toggle_"><span
                          class="font-small-3 text-muted mr-25">{{$comment->supportuser->email}}</span></button>                                            
              </div>
          </div>
      </div>
      <div class="mail-meta-item d-flex align-items-center"><small
              class="mail-date-time text-muted">{{$comment->created_at}}</small>
          <div class="dropdown b-dropdown btn-group" id="__BVID__1112">
              <!----><button aria-haspopup="true" aria-expanded="false" type="button"
                  class="btn dropdown-toggle btn-link p-0 dropdown-toggle-no-caret"
                  id="__BVID__1112__BV_toggle_"><svg xmlns="http://www.w3.org/2000/svg"
                      width="17px" height="17px" viewBox="0 0 24 24" fill="none"
                      stroke="currentColor" stroke-width="2" stroke-linecap="round"
                      stroke-linejoin="round"
                      class="ml-50 text-body feather feather-more-vertical">
                      <circle cx="12" cy="12" r="1"></circle>
                      <circle cx="12" cy="5" r="1"></circle>
                      <circle cx="12" cy="19" r="1"></circle>
                  </svg></button>
              <ul role="menu" tabindex="-1" class="dropdown-menu dropdown-menu-right"
                  aria-labelledby="__BVID__1112__BV_toggle_">
                  <li role="presentation"><a role="menuitem" href="#" target="_self"
                          class="dropdown-item"><svg xmlns="http://www.w3.org/2000/svg"
                              width="14px" height="14px" viewBox="0 0 24 24" fill="none"
                              stroke="currentColor" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round" class="feather feather-corner-up-left">
                              <polyline points="9 14 4 9 9 4"></polyline>
                              <path d="M20 20v-7a4 4 0 0 0-4-4H4"></path>
                          </svg><span class="align-middle ml-50">Reply</span></a></li>
                  <li role="presentation"><a role="menuitem" href="#" target="_self"
                          class="dropdown-item"><svg xmlns="http://www.w3.org/2000/svg"
                              width="14px" height="14px" viewBox="0 0 24 24" fill="none"
                              stroke="currentColor" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round" class="feather feather-corner-up-right">
                              <polyline points="15 14 20 9 15 4"></polyline>
                              <path d="M4 20v-7a4 4 0 0 1 4-4h12"></path>
                          </svg><span class="align-middle ml-50">Forward</span></a></li>
                  <li role="presentation"><a role="menuitem" href="#" target="_self"
                          class="dropdown-item"><svg xmlns="http://www.w3.org/2000/svg"
                              width="14px" height="14px" viewBox="0 0 24 24" fill="none"
                              stroke="currentColor" stroke-width="2" stroke-linecap="round"
                              stroke-linejoin="round" class="feather feather-trash">
                              <polyline points="3 6 5 6 21 6"></polyline>
                              <path
                                  d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                              </path>
                          </svg><span class="align-middle ml-50">Delete</span></a></li>
              </ul>
          </div>
      </div>
  </div>
  <div class="card-body mail-message-wrapper pt-2">
      <!---->
      <!---->
      <div class="mail-message">
          {!! $comment->comment !!}
         
      </div>
  </div>
  <div class="card-footer">
      <div class="mail-attachments">
          <div class="d-flex align-items-center mb-1">
              <svg xmlns="http://www.w3.org/2000/svg"
                  width="16px" height="16px" viewBox="0 0 24 24" fill="none"
                  stroke="currentColor" stroke-width="2" stroke-linecap="round"
                  stroke-linejoin="round" class="feather feather-paperclip">
                  <path
                      d="M21.44 11.05l-9.19 9.19a6 6 0 0 1-8.49-8.49l9.19-9.19a4 4 0 0 1 5.66 5.66l-9.2 9.19a2 2 0 0 1-2.83-2.83l8.49-8.48">
                  </path>
              </svg>
              <h5 class="font-weight-bolder text-body mb-0 ml-50"> {{ count($attachments) }} Attachment </h5>
          </div>
          <div class="d-flex flex-column">
              @foreach($attachments as $file)
              <a href="{{asset('storage/support_ticket_attachment/'.$ticket->customer->id.'/'.$file)}}" rel="noopener" target="_blank" class="">
              <img src=""
                      width="16" class="mr-50">
                      <span
                      class="text-muted font-weight-bolder align-text-top">{{$file}}</span>
                  </a>
              @endforeach
          </div>
      </div>
  </div>
  <!---->
  <!---->
</div>