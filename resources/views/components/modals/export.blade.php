<div class="modal fade" id="export_modal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <div class="modal-content">

                <div class="modal-header" id="kt_modal_update_customer_header">
                    <h2 class="fw-bolder">
                        Upload {{ $moduleName }} Excel
                        <span class="text-primary"></span>
                    </h2>
                    <div class="btn btn-icon btn-sm btn-active-icon-primary" data-bs-dismiss="modal"
                         aria-label="Close">
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                 height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16"
                                      height="2" rx="1"
                                      transform="rotate(-45 6 17.3137)" fill="black"/>
                                <rect x="7.41422" y="6" width="16" height="2" rx="1"
                                      transform="rotate(45 7.41422 6)" fill="black"/>
                            </svg>
                        </span>
                    </div>
                </div>
                <div class="modal-body py-10 px-lg-17">
                    <div class="d-flex flex-column scroll-y me-n7 pe-7" id="kt_modal_update_customer_scroll"
                         data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}"
                         data-kt-scroll-max-height="auto" data-kt-scroll-dependencies="#kt_modal_update_customer_header"
                         data-kt-scroll-wrappers="#kt_modal_update_customer_scroll" data-kt-scroll-offset="300px">

                        <div>

                            <div class="row">

                                <div class="fv-row mb-7 col-6">
                                    <label class="fs-6 fw-bold mb-2">start date</label>
                                    <input type="date"  class="form-control form-control-solid"
                                           name="start_date"
                                           exportType="target"
                                           onchange="addParams(this)"
                                           value=""/>
                                    <div class="invalid-feedback" id="start_dateMessage"></div>
                                </div>

                                <div class="fv-row mb-7 col-6">
                                    <label class="fs-6 fw-bold mb-2">end date</label>
                                    <input type="date"  class="form-control form-control-solid"
                                           name="end_date"
                                           exportType="target"
                                           onchange="addParams(this)"
                                           value=""/>
                                    <div class="invalid-feedback" id="end_dateMessage"></div>
                                </div>


                            </div>



                        </div>


                    </div>
                </div>

                <div class="modal-footer flex-center">
                    <button type="reset" data-bs-dismiss="modal" aria-label="Close" class="btn btn-light me-3">
                        Discard
                    </button>

                    <a data-action="{{ route('admin.display.export.target') }}"
                         onclick="exportTickets(this)"
                       id="exportTargetButton"
                         class="btn btn-primary btn-sm font-weight-bold mr-2 submit-btn">

                        <span class="indicator-label">
                            <i class="fa fa-check"></i>
                        Export
                        </span>

                        <span class="indicator-progress">
                           loading
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                        </span>
                    </a>


                </div>

        </div>
    </div>
</div>
