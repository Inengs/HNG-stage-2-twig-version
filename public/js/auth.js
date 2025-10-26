const SESSION_KEY = "ticketapp_session";

const auth = {
  login: (email, password) => {
    if (email && password) {
      const token = btoa(`${email}:${Date.now()}`);
      localStorage.setItem(SESSION_KEY, token);
      // Also set in PHP session via fetch
      fetch("/api/login", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ token }),
      });
      return { success: true, token };
    }
    return { success: false, error: "Invalid credentials" };
  },

  signup: (email, password, name) => {
    if (email && password && name) {
      const token = btoa(`${email}:${Date.now()}`);
      localStorage.setItem(SESSION_KEY, token);
      // Also set in PHP session
      fetch("/api/login", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ token }),
      });
      return { success: true, token };
    }
    return { success: false, error: "All fields are required" };
  },

  logout: () => {
    localStorage.removeItem(SESSION_KEY);
    // Also clear PHP session
    fetch("/api/logout", { method: "POST" });
  },

  isAuthenticated: () => {
    return localStorage.getItem(SESSION_KEY) !== null;
  },

  getToken: () => {
    return localStorage.getItem(SESSION_KEY);
  },

  // Set session on page load
  initSession: () => {
    const token = localStorage.getItem(SESSION_KEY);
    if (token) {
      fetch("/api/login", {
        method: "POST",
        headers: { "Content-Type": "application/json" },
        body: JSON.stringify({ token }),
      });
    }
  },
};

// Initialize session on page load
if (auth.isAuthenticated()) {
  auth.initSession();
}
