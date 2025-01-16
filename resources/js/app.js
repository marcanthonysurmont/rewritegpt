import './bootstrap';
import setupUI from './toggleMenus.js';
import showNotification from './notifications.js';

// Toggles
if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', () => {
        setupUI();
    });
} else {
    setupUI();
}

// Fetch response for API Key endpoint (POST)
function fetchAPIKeyResponse(formData) {
    fetch('/information/apikey', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())  // Parse the response as JSON
    .then(data => {
        if (data.success) {
            showNotification('success', data.success);  // Show success notification
        } else if (data.error) {
            showNotification('error', data.error);  // Show error notification
        }
    })
    .catch(error => {
        showNotification('error', 'An error occurred while processing your request.');
    });
}

// Fetch response for Prompt endpoint (POST)
function fetchPromptResponse(formData) {
    fetch('/information/prompt', {
        method: 'POST',
        body: formData,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            showNotification('success', data.success);  // Show success notification
        } else if (data.error) {
            showNotification('error', data.error);  // Show error notification
        }
    })
    .catch(error => {
        showNotification('error', 'An error occurred while processing your request.');
    });
}

const apiForm = document.getElementById('api_key_form');
apiForm.addEventListener('submit', (event) => {
    event.preventDefault(); 
    const formData = new FormData(apiForm); 
    fetchAPIKeyResponse(formData);
});

const promptForm = document.getElementById('prompt_form');
promptForm.addEventListener('submit', (event) => {
    event.preventDefault();
    const formData = new FormData(promptForm);
    fetchPromptResponse(formData);
});

window.Native.on("App\\Events\\JsonResponseEvent", (payload) => {

    if(payload.response.success) {
        showNotification('success', payload.response.success);
    }

    if(payload.response.error) {
        showNotification('error', payload.response.error);
    }
});