# Live URL

https://hng-stage-2-twig-version.vercel.app/

# TicketFlow - Twig/PHP Implementation

A modern ticket management web application built with Twig templating engine, PHP, and Tailwind CSS.

## Features

- 🎨 Modern UI with wavy hero section and decorative elements
- 🔐 Secure authentication system with protected routes
- 📊 Dashboard with ticket statistics
- ✅ Full CRUD operations for ticket management
- 📱 Fully responsive design (mobile, tablet, desktop)
- 🎯 Form validation with inline error messages
- 🔔 Toast notifications for user feedback
- ♿ Accessibility compliant

## Technologies Used

- **PHP 7.4+** - Server-side language
- **Twig 3.0** - Template engine
- **Tailwind CSS** - Utility-first CSS framework
- **Vanilla JavaScript** - Client-side interactivity
- **LocalStorage** - Client-side data persistence
- **PHP Sessions** - Server-side session management

## Prerequisites

- PHP 7.4 or higher
- Composer
- Apache/Nginx web server with mod_rewrite enabled
- Web browser with JavaScript enabled

## Installation & Setup

1. **Clone the repository**

```bash
   git clone <your-repo-url>
   cd ticket-app-twig
```

2. **Install dependencies**

```bash
   composer install
```

3. **Configure web server**

   **For Apache:**

   - Point your document root to the `public/` directory
   - Ensure `.htaccess` file exists in `public/`
   - Enable mod_rewrite: `sudo a2enmod rewrite`

   **For PHP Built-in Server (Development):**

```bash
   php -S localhost:8000 -t public
```

4. **Open in browser**
   Navigate to `http://localhost:8000`

## Project Structure

ticket-app-twig/
├── public/ # Web root
│ ├── index.php # Entry point & router
│ ├── .htaccess # URL rewriting
│ ├── css/
│ │ └── style.css # Custom styles
│ ├── js/
│ │ ├── auth.js # Authentication logic
│ │ ├── storage.js # LocalStorage management
│ │ └── main.js # Utilities & helpers
│ └── assets/
│ └── wave.svg # Hero wave graphic
├── src/
│ ├── views/ # Twig templates
│ │ ├── landing.twig
│ │ ├── login.twig
│ │ ├── signup.twig
│ │ ├── dashboard.twig
│ │ └── tickets.twig
│ ├── components/ # Reusable Twig components
│ │ ├── layout.twig
│ │ └── ticket-card.twig
│ └── Router.php # Custom router class
├── vendor/ # Composer dependencies
├── composer.json
└── README.md

## UI Components

### Landing Page

- Hero section with gradient background and wavy SVG
- Decorative circular elements
- Feature boxes with shadows and rounded corners
- Call-to-action buttons for Login and Signup
- Responsive grid layout

### Authentication

- Login and Signup forms with client-side validation
- Real-time error messages below fields
- Toast notifications for success/failure
- Password confirmation on signup
- Session management via PHP + LocalStorage

### Dashboard

- Ticket statistics cards (Total, Open, In Progress, Closed)
- Color-coded status indicators
- Quick action buttons
- Logout functionality

### Ticket Management

- Create new tickets with form validation
- View all tickets in card layout
- Edit existing tickets inline
- Delete tickets with JavaScript confirmation
- Status badges with color coding:
  - **Green**: Open tickets
  - **Amber**: In Progress tickets
  - **Gray**: Closed tickets

## Data Validation Rules

### Mandatory Fields

- **Title**: Required, cannot be empty
- **Status**: Required, must be one of: `open`, `in_progress`, `closed`

### Optional Fields

- **Description**: Max 500 characters
- **Priority**: Low, Medium, or High

## Authentication System

### Session Management

- Uses PHP `$_SESSION` with key: `ticketapp_session`
- Also stores in browser `localStorage` for client-side checks
- Dual-layer authentication (server + client)
- Protected routes redirect to login if unauthorized

### Test Credentials

Any email and password combination will work for testing:

- **Email**: test@example.com
- **Password**: password123

## Error Handling

The app handles the following error scenarios:

1. **Form Validation Errors**

   - Empty required fields
   - Invalid email format
   - Password mismatch
   - Invalid status values
   - Description length exceeded

2. **Authentication Errors**

   - Invalid credentials
   - Expired sessions
   - Unauthorized access attempts

3. **CRUD Operation Errors**
   - Failed to create ticket
   - Failed to update ticket
   - Failed to delete ticket

All errors display user-friendly messages via:

- Inline error messages (below form fields)
- Toast notifications (top-right corner)

## Accessibility Features

- Semantic HTML5 elements
- Proper heading hierarchy
- Focus states for interactive elements
- Color contrast compliance (WCAG AA)
- Alt text for images
- Keyboard navigation support
- ARIA labels where appropriate

## Responsive Design

- **Mobile** (< 768px): Stacked layout, full-width elements
- **Tablet** (768px - 1024px): 2-column grid
- **Desktop** (> 1024px): 3-column grid, max-width 1440px

## Twig Features Used

- **Template Inheritance** - `{% extends %}` for layouts
- **Blocks** - `{% block %}` for content sections
- **Filters** - `|replace` for string manipulation
- **Conditionals** - `{% if %}` for conditional rendering
- **Loops** - Server-rendered in this implementation
- **Components** - Reusable template partials

## API Endpoints

- `POST /api/login` - Set PHP session
- `POST /api/logout` - Clear PHP session

## Known Issues

None at this time.

## Browser Support

- Chrome (latest)
- Firefox (latest)
- Safari (latest)
- Edge (latest)

## Development

### Running Tests

No automated tests included in it.
