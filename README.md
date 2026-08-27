# Perfume E-Commerce Project

This is a luxury perfume e-commerce store built with Laravel, Tailwind CSS, Alpine.js, and GSAP.

## Completed Features (What we have done so far)
- [x] **Project Initialization**: Merged the UI skeleton with the core Laravel framework files.
- [x] **Database Setup**: Created the MySQL database (`perfume_ecommerce`), ran all migrations, and seeded the database with categories, perfumes, an admin, and a customer account.
- [x] **Core Architecture**: Full DB schema, models, relationships, routes, and controllers for browsing, cart, checkout (COD), order history, and admin CRUD.
- [x] **Authentication**: Setup register, login, and logout flows with role-based middleware (`admin` and `customer`).
- [x] **Frontend & Animations**: Tailwind CSS compilation via Vite, custom cursor, GSAP scroll reveals, product card hovers, and video hero section.
- [x] **Live Search**: Implemented a JSON API endpoint and an Alpine.js-powered search overlay in the navigation bar for instant, debounced "search-as-you-type" functionality.

## Upcoming Tasks (What we have to do next)
- [ ] **Image Optimization**: Set up an image optimization / WebP pipeline for fast loading of high-res perfume images.
- [ ] **Payment Gateway**: Integrate an online payment gateway (e.g., Stripe or PayPal) beyond the existing "Cash on Delivery" option.
- [ ] **Email Notifications**: Wire up automated email notifications for order confirmations and registration.
- [ ] **Automated Testing**: Write PHPUnit/Pest automated tests to cover critical application flows (like checkout and cart logic).

## How to Run the Project
1. Start the backend: `php artisan serve`
2. Start the frontend: `npm run dev`
3. Visit `http://localhost:8000`

**Test Accounts:**
- Admin: `admin@maisonnoir.example` / `password`
- Customer: `customer@maisonnoir.example` / `password`
