    <!-- Confirmation Modal -->
    <div id="saveRoleModal" class="custom-modal-backdrop hidden" role="dialog" aria-modal="true" aria-labelledby="modalTitle">
        <div class="custom-modal">
            <div class="custom-modal-content">
                <div class="custom-modal-header">
                    <h5 class="custom-modal-title" id="modalTitle">Save Role?</h5>
                </div>
                <div class="custom-modal-body">
                    <p>Are you sure you want to change this user's role?</p>
                </div>
                <div class="custom-modal-footer">
                    <button type="button" id="cancelbtn" class="cancelbtn custom-btn secondary">Cancel</button>
                    <button type="button" class="custom-btn primary" id="confirmSaveBtn">Yes</button>
                </div>
            </div>
        </div>
    </div>


    <!-- Success Modal Picture -->
    <div id="successModalRole" class="custom-modal-backdrop hidden">
        <div class="custom-modal-box">
            <p id="modalMessage">Role Updated Successfully!</p>
            <button id="modalOkBtn" class="btn btn-primary">OK</button>
        </div>
    </div>