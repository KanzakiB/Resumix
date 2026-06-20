    <div class="modal fade" id="userFilterModal" tabindex="-1" aria-labelledby="userFilterModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userFilterModalLabel">Filter</h5>
                </div>
                <form method="get" action="">
                    <div class="modal-body">
                        <div class="modaldiv">
                            <h6 class="titlecont mb-2">Name</h6>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sort" id="name_asc" value="name_asc" <?= ($sort ?? '') === 'name_asc' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="name_asc">
                                    A - Z (Ascending)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sort" id="name_desc" value="name_desc" <?= ($sort ?? '') === 'name_desc' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="name_desc">
                                    Z - A (Descending)
                                </label>
                            </div>
                        </div>
                        <div class="mt-3 modaldiv">
                            <h6 class="titlecont mb-2">Count</h6>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sort" id="date_newest" value="date_newest" <?= ($sort ?? '') === 'date_newest' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="date_newest">
                                    Times Used (High - Low)
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="radio" name="sort" id="date_oldest" value="date_oldest" <?= ($sort ?? '') === 'date_oldest' ? 'checked' : '' ?>>
                                <label class="form-check-label" for="date_oldest">
                                    Downloads (High - Low)
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <button type="button" class="cancelbtn btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                        <button type="submit" class="sortbtn btn btn-primary">Sort</button>
                    </div>

                    <input type="hidden" name="search" value="<?= htmlspecialchars($search ?? '') ?>">
                    <input type="hidden" name="page" value="1">
                </form>
            </div>
        </div>
    </div>

    <!--PREVIEW MODAL -->
    <div class="modal fade" id="cvPreviewModal" tabindex="-1" aria-labelledby="cvPreviewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered d-flex justify-content-center">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="cvPreviewModalLabel">Template Preview</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex justify-content-center align-items-center" style="min-height: 80vh;">
                    <img id="previewImage" src="" alt="Resume Template" class="img-fluid mx-auto d-block" style="max-height: 90vh;">
                </div>
            </div>
        </div>
    </div>


    <!-- Delete Confirmation Modal -->
    <div id="DeleteModal" class="custom-modal-backdrop hidden" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
        <div class="custom-modal">
            <div class="custom-modal-content">
                <div class="custom-modal-header">
                    <h5 class="custom-modal-title" id="modalTitle">Delete</h5>
                </div>
                <div class="custom-modal-body">
                    <p>Are you sure you want to delete this Template?</p>
                </div>
                <div class="custom-modal-footer justify-content-center">
                    <button type="button" id="nobtn" class="nobtn custom-btn secondary">No</button>
                    <button type="button" class="custom-btn primary" id="confirmDelete">Yes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Success Modal Delete -->
    <div id="successModalRole" class="custom-modal-backdrop hidden">
        <div class="custom-modal-box">
            <p id="modalMessage">Deleted Successfully!</p>
            <button id="modalOkBtn" class="btn btn-primary">OK</button>
        </div>
    </div>
    