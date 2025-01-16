// Function to show notifications
function showNotification(type, message) {
  const container = document.getElementById('notification-container');
  
  // Create notification
  const notification = document.createElement('div');
  notification.className = `px-6 py-4 rounded-lg shadow-xl flex items-center space-x-4 opacity-0 transform translate-x-12 ${
    type === 'success' ? 'bg-green-600 text-white' : 'bg-red-600 text-white'
  } transition-all duration-300 ease-in-out max-w-sm w-full`;

  // Icons for success and error
  const icon = type === 'success' 
      ? '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>' 
      : '<svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>';

  // Notification content
  notification.innerHTML = `
    <div class="flex items-center space-x-4">
      <div class="flex-shrink-0">${icon}</div>
      <div>
        <span class="font-semibold">${type === 'success' ? 'Success!' : 'Error!'}</span>
        <p class="text-sm">${message}</p>
      </div>
    </div>
  `;

  // Append to container
  container.appendChild(notification);

  // Trigger animation (fade-in and slide-in from the right)
  setTimeout(() => {
      notification.classList.remove('opacity-0', 'translate-x-12');
      notification.classList.add('opacity-100', 'translate-x-0');
  }, 10);  // Slight delay for the animation to start

  // Auto-remove after 3 seconds with fade-out
  setTimeout(() => {
      notification.classList.remove('opacity-100', 'translate-x-0');
      notification.classList.add('opacity-0', 'translate-x-12');
      
      // Remove element after animation ends
      setTimeout(() => notification.remove(), 300);
  }, 3000);
}

export default showNotification;
