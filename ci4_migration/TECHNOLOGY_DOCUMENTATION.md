# Technology Documentation

This document provides comprehensive documentation for the technologies used in the CodeIgniter 3 to CodeIgniter 4 migration project.

## Table of Contents
1. [CodeIgniter 4](#codeigniter-4)
2. [Bootstrap 5](#bootstrap-5)
3. [HTMX](#htmx)
4. [DataTables](#datatables)
5. [Font Awesome](#font-awesome)

---

## CodeIgniter 4

### Overview
CodeIgniter 4 is a powerful PHP framework designed for building modern web applications with a small footprint and exceptional performance.

### Key Features
- **Modern PHP Support**: Requires PHP 7.4 or higher
- **Improved Performance**: Faster than CI3 with optimized autoloading
- **Better Security**: Built-in CSRF protection and security features
- **Modular Structure**: Cleaner separation of concerns
- **Powerful CLI**: Spark command-line tool for various tasks

### Development Server
```bash
# Start the development server
php spark serve

# Specify custom port
php spark serve --port 8081

# Specify custom host
php spark serve --host example.dev
```

### Key Changes from CI3 to CI4

#### Method Signatures
- **CI3**: `$this->input->post()`
- **CI4**: `$this->request->getPost()`

- **CI3**: `$this->session->flashdata()`
- **CI4**: `session()->getFlashdata()`

- **CI3**: `redirect('controller/method')`
- **CI4**: `return redirect()->to('controller/method')`

- **CI3**: `$this->load->view()`
- **CI4**: `view()`

#### File Handling
- **CI3**: `$_FILES['file']['tmp_name']`
- **CI4**: `$this->request->getFile('file')`

#### Response Handling
- **CI3**: `echo json_encode()`
- **CI4**: `return $this->response->setJSON()`

### Controllers

#### BaseController
All controllers extend from `BaseController` which provides common functionality:

```php
/**
 * @context7 /codeigniter/controller
 * @description Base controller with common functionality
 */
class BaseController extends Controller
{
    /**
     * @context7 /codeigniter/controller/method
     * @description Render view with common template structure
     */
    protected function renderView($view, $data = [])
    {
        return view($view, $data);
    }
    
    /**
     * @context7 /codeigniter/controller/method
     * @description Simple view rendering without template
     */
    protected function simpleView($view, $data = [])
    {
        return view($view, $data);
    }
}
```

#### Filters
CI4 introduces a filter system for access control:

```php
/**
 * @context7 /codeigniter/filter
 * @description Filter for admin authentication
 */
class AdminAuthFilter implements FilterInterface
{
    public function before(RequestInterface $request, $arguments = null)
    {
        if (!session()->get('admin')) {
            return redirect()->to('/login/admin');
        }
    }
}
```

### Routes
CI4 provides a more flexible routing system:

```php
/**
 * @context7 /codeigniter/route
 * @description Route configuration with groups and filters
 */
$routes->group('admin', ['filter' => 'admin-auth'], function($routes) {
    $routes->get('/', 'Admin::index');
    $routes->get('dashboard', 'Admin::dashboard');
});
```

---

## Bootstrap 5

### Overview
Bootstrap 5 is the latest major version of the world's most popular front-end component library.

### Key Features
- **No jQuery Dependency**: Bootstrap 5 drops jQuery in favor of vanilla JavaScript
- **CSS Custom Properties**: Better theming and customization
- **Improved Grid System**: More flexible and powerful grid layout
- **Enhanced Components**: Updated and improved component designs
- **Better Accessibility**: Improved ARIA support and keyboard navigation

### Components

#### Cards
```html
/**
 * @context7 /bootstrap/card
 * @description Responsive card component with header and body
 */
<div class="card shadow">
    <div class="card-header bg-primary text-white">
        <h5 class="mb-0">Card Title</h5>
    </div>
    <div class="card-body">
        <p class="card-text">Card content goes here.</p>
    </div>
</div>
```

#### Forms
```html
/**
 * @context7 /bootstrap/form
 * @description Modern form with validation styling
 */
<form class="needs-validation" novalidate>
    <div class="mb-3">
        <label for="username" class="form-label">Username</label>
        <input type="text" class="form-control" id="username" required>
        <div class="invalid-feedback">
            Please provide a valid username.
        </div>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
</form>
```

#### Badges with Text-Background Utilities
```html
/**
 * @context7 /bootstrap/badge
 * @description Badges with background color utilities
 */
<span class="badge text-bg-primary">Primary</span>
<span class="badge text-bg-success">Success</span>
<span class="badge text-bg-danger">Danger</span>
```

#### Flexbox Media Object
```html
/**
 * @context7 /bootstrap/flex
 * @description Media object using flexbox utilities
 */
<div class="d-flex">
    <div class="flex-shrink-0">
        <img src="..." alt="..." class="rounded">
    </div>
    <div class="flex-grow-1 ms-3">
        <h5>Media heading</h5>
        <p>Cras sit amet nibh libero.</p>
    </div>
</div>
```

### Utilities

#### Text Utilities
```html
/**
 * @context7 /bootstrap/text
 * @description Text transformation utilities
 */
<p class="text-lowercase">Lowercased text.</p>
<p class="text-uppercase">Uppercased text.</p>
<p class="text-capitalize">CapiTaliZed text.</p>
```

#### Text Break
```html
/**
 * @context7 /bootstrap/text
 * @description Prevent long text from breaking layout
 */
<p class="text-break">mmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmmm</p>
```

### Customization with Sass

#### Adding Custom Utilities
```scss
/**
 * @context7 /bootstrap/sass
 * @description Add custom cursor utility using Bootstrap's API
 */
@import "bootstrap/scss/functions";
@import "bootstrap/scss/variables";
@import "bootstrap/scss/maps";
@import "bootstrap/scss/mixins";
@import "bootstrap/scss/utilities";

$utilities: map-merge(
  $utilities,
  (
    "cursor": (
      property: cursor,
      class: cursor,
      responsive: true,
      values: auto pointer grab,
    )
  )
);

@import "bootstrap/scss/utilities/api";
```

#### Removing Utilities
```scss
/**
 * @context7 /bootstrap/sass
 * @description Remove unused utilities to reduce CSS size
 */
$utilities: map-remove($utilities, "width", "float");
```

---

## HTMX

### Overview
HTMX is a library that allows you to access modern browser features directly from HTML, rather than using JavaScript.

### Key Features
- **AJAX Requests**: Make AJAX requests directly from HTML
- **CSS Transitions**: Trigger CSS transitions on requests
- **WebSockets**: Support for WebSocket connections
- **Server Sent Events**: SSE support directly in HTML
- **Simple Integration**: Works with any backend technology

### Core Attributes

#### Request Attributes
```html
/**
 * @context7 /htmx/request
 * @description Basic AJAX request attributes
 */
<!-- GET request -->
<button hx-get="/data">Load Data</button>

<!-- POST request -->
<button hx-post="/submit">Submit Form</button>

<!-- PUT request -->
<button hx-put="/update">Update Resource</button>

<!-- DELETE request -->
<button hx-delete="/delete">Delete Resource</button>
```

#### Target and Swap
```html
/**
 * @context7 /htmx/target
 * @description Control where and how content is swapped
 */
<div id="result">
    <button hx-post="/submit" hx-target="#result" hx-swap="innerHTML">
        Submit
    </button>
</div>
```

#### Triggers
```html
/**
 * @context7 /htmx/trigger
 * @description Control when requests are triggered
 */
<button hx-post="/submit" hx-trigger="click">
    Submit on Click
</button>

<button hx-post="/submit" hx-trigger="keyup changed delay:500ms">
    Submit on Type
</button>
```

#### Request Configuration
```html
/**
 * @context7 /htmx/config
 * @description Configure request settings
 */
<div hx-get="/data" hx-request='{"timeout": 2000}'>
    Load Data with 2s timeout
</div>
```

#### Parameters and Values
```html
/**
 * @context7 /htmx/params
 * @description Control request parameters
 */
<div hx-get="/search" hx-params="*" hx-vals='{"type": "advanced"}'>
    Advanced Search
</div>
```

#### User Confirmation
```html
/**
 * @context7 /htmx/confirmation
 * @description Prompt user before making request
 */
<button hx-delete="/account" hx-prompt="Enter account name to confirm">
    Delete Account
</button>
```

#### Disable During Request
```html
/**
 * @context7 /htmx/disable
 * @description Disable element during request
 */
<button hx-post="/submit" hx-disabled-elt="this">
    Submit (disabled during request)
</button>
```

---

## DataTables

### Overview
DataTables is a powerful jQuery plugin that enhances HTML tables with advanced features like searching, sorting, and pagination.

### Key Features
- **Pagination**: Automatic pagination of large datasets
- **Search/Filtering**: Instant search across table data
- **Sorting**: Multi-column sorting capabilities
- **Responsive Design**: Adapts to different screen sizes
- **Export Options**: Export data to CSV, Excel, PDF
- **Internationalization**: Support for multiple languages

### Basic Initialization
```javascript
/**
 * @context7 /datatables/initialization
 * @description Basic DataTables initialization
 */
$('#myTable').DataTable({
    responsive: true,
    pageLength: 10,
    language: {
        url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
    }
});
```

### Advanced Configuration
```javascript
/**
 * @context7 /datatables/advanced
 * @description Advanced DataTables configuration
 */
$('#advancedTable').DataTable({
    responsive: true,
    pageLength: 25,
    lengthMenu: [[10, 25, 50, -1], [10, 25, 50, "All"]],
    dom: 'Bfrtip',
    buttons: [
        'copy', 'csv', 'excel', 'pdf', 'print'
    ],
    language: {
        search: "Cari:",
        lengthMenu: "Tampilkan _MENU_ entri",
        info: "Menampilkan _START_ sampai _END_ dari _TOTAL_ entri",
        paginate: {
            first: "Pertama",
            last: "Terakhir",
            next: "Selanjutnya",
            previous: "Sebelumnya"
        }
    },
    columnDefs: [
        { targets: 0, orderable: false },
        { targets: -1, className: 'text-center' }
    ]
});
```

### AJAX Data Source
```javascript
/**
 * @context7 /datatables/ajax
 * @description DataTables with AJAX data source
 */
$('#ajaxTable').DataTable({
    processing: true,
    serverSide: true,
    ajax: {
        url: '/admin/lihat_ajax',
        type: 'GET',
        data: function(d) {
            d.gender = $('#genderFilter').val();
        }
    },
    columns: [
        { data: 'id' },
        { data: 'name' },
        { data: 'email' },
        { 
            data: 'actions',
            orderable: false,
            render: function(data, type, row) {
                return '<button class="btn btn-sm btn-primary">Edit</button>';
            }
        }
    ]
});
```

---

## Font Awesome 6

### Overview
Font Awesome is the internet's icon library and toolkit, used by millions of designers, developers, and content creators.

### Key Features
- **Vector Icons**: Scalable icons that look great at any size
- **Multiple Styles**: Solid, Regular, Light, Thin, and Duotone styles
- **Accessibility**: Built-in accessibility features
- **CSS Framework Integration**: Works seamlessly with Bootstrap
- **Custom Icons**: Create and use custom icons

### Basic Usage
```html
/**
 * @context7 /fontawesome/basic
 * @description Basic Font Awesome icon usage
 */
<i class="fas fa-user"></i> <!-- Solid style -->
<i class="far fa-user"></i> <!-- Regular style -->
<i class="fab fa-github"></i> <!-- Brand icon -->
```

### Sizing
```html
/**
 * @context7 /fontawesome/sizing
 * @description Icon sizing utilities
 */
<i class="fas fa-camera fa-xs"></i> <!-- Extra small -->
<i class="fas fa-camera fa-sm"></i> <!-- Small -->
<i class="fas fa-camera"></i> <!-- Default -->
<i class="fas fa-camera fa-lg"></i> <!-- Large -->
<i class="fas fa-camera fa-2x"></i> <!-- 2x larger -->
<i class="fas fa-camera fa-3x"></i> <!-- 3x larger -->
```

### Animation
```html
/**
 * @context7 /fontawesome/animation
 * @description Animated icons
 */
<i class="fas fa-spinner fa-spin"></i> <!-- Spinning -->
<i class="fas fa-sync fa-pulse"></i> <!-- Pulsing -->
```

### Stacking
```html
/**
 * @context7 /fontawesome/stack
 * @description Stacked icons
 */
<span class="fa-stack fa-lg">
  <i class="fas fa-circle fa-stack-2x text-danger"></i>
  <i class="fas fa-times fa-stack-1x fa-inverse"></i>
</span>
```

### Common Icons for PPDB System
```html
/**
 * @context7 /fontawesome/ppdb
 * @description Common icons used in PPDB system
 */
<!-- User actions -->
<i class="fas fa-user-edit"></i> <!-- Edit user -->
<i class="fas fa-user-plus"></i> <!-- Add user -->
<i class="fas fa-user-times"></i> <!-- Delete user -->

<!-- File operations -->
<i class="fas fa-file-upload"></i> <!-- Upload file -->
<i class="fas fa-file-download"></i> <!-- Download file -->
<i class="fas fa-file-pdf"></i> <!-- PDF file -->

<!-- Navigation -->
<i class="fas fa-home"></i> <!-- Home -->
<i class="fas fa-dashboard"></i> <!-- Dashboard -->
<i class="fas fa-cog"></i> <!-- Settings -->

<!-- Status -->
<i class="fas fa-check-circle text-success"></i> <!-- Success -->
<i class="fas fa-exclamation-triangle text-warning"></i> <!-- Warning -->
<i class="fas fa-times-circle text-danger"></i> <!-- Error -->

<!-- Communication -->
<i class="fas fa-envelope"></i> <!-- Email -->
<i class="fas fa-phone"></i> <!-- Phone -->
<i class="fas fa-print"></i> <!-- Print -->
```

---

## Integration Examples

### HTMX with Bootstrap 5
```html
/**
 * @context7 /integration/htmx-bootstrap
 * @description HTMX integration with Bootstrap components
 */
<div class="card">
    <div class="card-header">
        <h5 class="card-title mb-0">
            <i class="fas fa-users me-2"></i>
            User Management
        </h5>
    </div>
    <div class="card-body">
        <div id="userList">
            <!-- Content loaded via HTMX -->
        </div>
        <button class="btn btn-primary" 
                hx-get="/users" 
                hx-target="#userList"
                hx-indicator="#loading">
            <i class="fas fa-refresh me-2"></i>
            Refresh Users
        </button>
        <div id="loading" class="htmx-indicator d-none">
            <div class="spinner-border spinner-border-sm" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>
</div>
```

### DataTables with Bootstrap 5
```javascript
/**
 * @context7 /integration/datatables-bootstrap
 * @description DataTables with Bootstrap 5 styling
 */
$(document).ready(function() {
    $('#registrantsTable').DataTable({
        responsive: true,
        pageLength: 10,
        dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>' +
             '<"row"<"col-sm-12"tr>>' +
             '<"row"<"col-sm-12 col-md-5"i><"col-sm-12 col-md-7"p>>',
        language: {
            url: "//cdn.datatables.net/plug-ins/1.10.24/i18n/Indonesian.json"
        },
        buttons: [
            {
                extend: 'excel',
                className: 'btn btn-success btn-sm',
                text: '<i class="fas fa-file-excel me-2"></i>Export Excel'
            },
            {
                extend: 'pdf',
                className: 'btn btn-danger btn-sm',
                text: '<i class="fas fa-file-pdf me-2"></i>Export PDF'
            }
        ]
    });
});
```

### Complete Form Example
```html
/**
 * @context7 /integration/complete-form
 * @description Complete form with all technologies
 */
<form class="needs-validation" 
      hx-post="/registrant/save" 
      hx-target="#formResult" 
      hx-indicator="#loadingSpinner"
      novalidate>
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="fas fa-user-plus me-2"></i>
                Registration Form
            </h5>
        </div>
        <div class="card-body">
            <div class="mb-3">
                <label for="name" class="form-label">
                    <i class="fas fa-user me-1"></i>
                    Full Name
                </label>
                <input type="text" 
                       class="form-control" 
                       id="name" 
                       name="name"
                       required>
                <div class="invalid-feedback">
                    Please provide your full name.
                </div>
            </div>
            
            <div class="mb-3">
                <label for="email" class="form-label">
                    <i class="fas fa-envelope me-1"></i>
                    Email
                </label>
                <input type="email" 
                       class="form-control" 
                       id="email" 
                       name="email"
                       required>
                <div class="invalid-feedback">
                    Please provide a valid email.
                </div>
            </div>
            
            <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                <button type="reset" class="btn btn-secondary">
                    <i class="fas fa-times me-2"></i>
                    Reset
                </button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save me-2"></i>
                    Save
                    <div id="loadingSpinner" class="spinner-border spinner-border-sm ms-2 d-none" 
                         role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </button>
            </div>
        </div>
    </div>
    
    <div id="formResult" class="mt-3"></div>
</form>
```

---

## Best Practices

### Performance Optimization
1. **Asset Caching**: Use versioned assets for proper caching
2. **Lazy Loading**: Implement lazy loading for images and components
3. **Minification**: Minify CSS and JavaScript files
4. **CDN Usage**: Use CDNs for external libraries when possible
5. **Service Workers**: Implement service workers for offline support

### Security Considerations
1. **CSRF Protection**: Enable CSRF tokens in forms
2. **Input Validation**: Validate all user inputs on both client and server
3. **XSS Prevention**: Escape all output data
4. **Authentication**: Use proper authentication and authorization
5. **HTTPS**: Always use HTTPS in production

### Accessibility
1. **Semantic HTML**: Use proper HTML5 semantic elements
2. **ARIA Labels**: Add appropriate ARIA labels for screen readers
3. **Keyboard Navigation**: Ensure all functionality is keyboard accessible
4. **Color Contrast**: Maintain proper color contrast ratios
5. **Focus Management**: Properly manage focus for dynamic content

This documentation provides a comprehensive guide for working with the technologies used in the PPDB system migration from CodeIgniter 3 to CodeIgniter 4.