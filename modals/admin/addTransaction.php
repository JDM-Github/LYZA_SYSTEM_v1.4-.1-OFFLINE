<div class="modal fade" id="uploadTransaction" tabindex="-1" aria-labelledby="uploadTransactionLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="uploadTransactionLabel">Upload Transaction Report</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="createBranchForm" method="POST" action="backend/redirector.php" enctype="multipart/form-data">
                    <div class="mb-3">
                        <input type="hidden" name="type" value="upload-transaction">
                        <label for="transactionFile" class="form-label">Choose File (ENC)</label>
                        <input type="file" class="form-control" id="transactionFile" name="transactionFile"
                            accept=".enc" required>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-secondary" form="createBranchForm">Upload</button>
            </div>
        </div>
    </div>
</div>