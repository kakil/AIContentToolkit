



<div class="modal fade" id="chatgpt-modal" tabindex="-1" role="dialog" aria-labelledby="chatgpt-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="chatgpt-modal-label">Chat with GPT</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="chatgpt-form">
                        <div class="form-group">
                            <label for="chatgpt-prompt">Enter your prompt:</label>
                            <input type="text" class="form-control" id="chatgpt-prompt" name="prompt">
                        </div>
                        <div class="form-group">
                            <label for="chatgpt-response">Response:</label>
                            <textarea class="form-control" id="chatgpt-response" name="response" rows="3" readonly></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="chatgpt-submit">Submit</button>
                </div>
            </div>
        </div>
    </div>
    