// Toast notification system
class ToastManager {
  constructor() {
    this.container = null;
  }

  show(message, type = "info") {
    if (!this.container) {
      this.container = document.createElement("div");
      this.container.className = "toast-container";
      document.body.appendChild(this.container);
    }

    const toast = document.createElement("div");
    const bgColors = {
      success: "bg-green-500",
      error: "bg-red-500",
      info: "bg-blue-500",
    };

    toast.className = `fixed top-4 right-4 ${bgColors[type]} text-white px-6 py-3 rounded-lg shadow-lg z-50 animate-slide-in`;
    toast.textContent = message;

    this.container.appendChild(toast);

    setTimeout(() => {
      toast.remove();
    }, 3000);
  }
}

const toast = new ToastManager();

// Form validation helpers
const validators = {
  email: (email) => {
    return /\S+@\S+\.\S+/.test(email);
  },

  required: (value) => {
    return value && value.trim() !== "";
  },

  minLength: (value, length) => {
    return value && value.length >= length;
  },

  maxLength: (value, length) => {
    return !value || value.length <= length;
  },

  inArray: (value, array) => {
    return array.includes(value);
  },
};

// Show inline error
function showError(inputId, message) {
  const input = document.getElementById(inputId);
  const errorEl = input.nextElementSibling;

  if (errorEl && errorEl.classList.contains("error-message")) {
    errorEl.textContent = message;
  } else {
    const error = document.createElement("p");
    error.className = "error-message text-red-500 text-sm mt-1";
    error.textContent = message;
    input.parentNode.insertBefore(error, input.nextSibling);
  }
}

// Clear all errors
function clearErrors() {
  document.querySelectorAll(".error-message").forEach((el) => el.remove());
}
