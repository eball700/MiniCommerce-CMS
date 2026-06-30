USE minicommerce_cms;

INSERT INTO users (name, email, password_hash, role)
VALUES
('Admin User', 'admin@example.com', '$2y$10$E9QZgY4xA4Qw6lXOD0PbI.b7yVb3ONKsxv1ztB0m9pjRkEv4gAa9W', 'admin');

INSERT INTO settings (setting_key, setting_value)
VALUES
('site_name', 'MiniCommerce CMS'),
('contact_email', 'contact@example.com');

INSERT INTO pages (title, slug, content, meta_title, meta_description, status)
VALUES
('About Us', 'about-us', '<p>Welcome to MiniCommerce CMS. This is a custom-built PHP application with CMS and eCommerce features.</p>', 'About Us - MiniCommerce CMS', 'Learn more about MiniCommerce CMS.', 'published'),
('Contact', 'contact', '<p>You can contact us at contact@example.com.</p>', 'Contact - MiniCommerce CMS', 'Contact MiniCommerce CMS.', 'published'),
('Privacy Policy', 'privacy-policy', '<p>This is a sample privacy policy page.</p>', 'Privacy Policy - MiniCommerce CMS', 'Read our privacy policy.', 'draft');

INSERT INTO categories (name, slug)
VALUES
('Electronics', 'electronics'),
('Books', 'books'),
('Accessories', 'accessories');

INSERT INTO products (category_id, name, slug, description, price, image, status, is_featured)
VALUES
(1, 'Wireless Headphones', 'wireless-headphones', 'Comfortable wireless headphones with clear sound quality.', 59.90, NULL, 'published', 1),
(1, 'Smart Watch', 'smart-watch', 'A simple smart watch for daily activity tracking.', 89.00, NULL, 'published', 1),
(2, 'PHP Development Book', 'php-development-book', 'A practical book for learning modern PHP development.', 29.50, NULL, 'published', 1),
(3, 'Laptop Sleeve', 'laptop-sleeve', 'Protective laptop sleeve for everyday use.', 19.99, NULL, 'published', 0),
(3, 'USB-C Adapter', 'usb-c-adapter', 'Compact USB-C adapter with multiple ports.', 24.99, NULL, 'draft', 0);