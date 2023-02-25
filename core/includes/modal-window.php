
<?php

include "header.php";

?>

<!-- Button trigger modal -->
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#chatgpt-modal">Chat with GPT</button>

<div class="modal fade" id="chatgpt-modal" tabindex="-1" aria-labelledby="chatgpt-modal-label" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <img src="<?php echo AICONTENTT_PLUGIN_URL . 'core/includes/assets/images/AI_Content_Toolkit_Small_Logo_60x60.png'; ?>">
                    <h5 class="modal-title ms-2" id="chatgpt-modal-label">Chat with GPT</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="chatgpt-form" action="#" method="post">
                        <div class="mb-3">
                            <label for="chatgpt-prompt" class="form-label">Enter your prompt:</label>
                            <input type="text" class="form-control" id="chatgpt-prompt" name="prompt">
                        </div>
                        <div class="mb-3">
                            <label for="chatgpt-response" class="form-label">Response:</label>
                            <textarea class="form-control" id="chatgpt-response" name="response" rows="3" readonly></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>