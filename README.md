
# 📦 Laravel  eCommerce System


## 🚀 Overview


## 🛠 Features



## 📜 Technologies Used

- **Laravel**: The PHP framework used for building the API.
- **MySQL**: Database management system.
- **JWT Authentication**: For secure API access.
- **Google OAuth**: For social login integration.
- **Payment 3rd Party Integration**: For complete order payment via (Visa Card | Online Card | Mobile Wallet).

## 🗂 Database Schema

The database consists of the following tables:

- **Users**: `email`, `phone`, `first_name`, `last_name`, `password`, `address`, `image`, `dob`, `status`
- **Vendors**: `shop_email`, `shop_phone`, `shop_name_en`, `shop_name_ar`, `shop_address`, `shop_logo`, `description`
- **Categories**: `name_en`, `name_ar`, `slug`, `description`, `icon`, `image`, `parent_id`
- **Tags**: `name_en`, `name_ar`
- **Products**: `name_en`, `name_ar`, `main_image`, `price`, `stock`, `description`, `category_id`, `vendor_id`, `status`
- **Product Images**: `product_id`, `image`
- **Product Tag**: `product_id`, `tag_id`
- **Payment Methods**: `name`, `description`, `status`, `icon`
- **Vendor Payment Method**: `vendor_id`, `payment_method_id`, `identifier`, `integration_id`
- **Orders**: `user_id`, `payment_method_id`, `total_amount`, `order_date`, `shipping_address`
- **Order Products**: `order_id`, `product_id`, `price`, `quantity`

## Routes

## 🔗 API Routes

### Auth Routes

- **Guest Routes**:
    - `POST /auth/login`: Login
    - `POST /auth/register/customer`: Register Customer

- **Authenticated Routes**:

### Customer Routes


### Customer Order Routes


### Vendor Routes


### Payment Methods Routes


### Vendor Payment Methods Routes


### Tag Routes


### Category Routes


### Product Routes


### Admin Routes

## 🛠 Installation

1. **Clone the Repository:**

   ```bash
   git clone https://github.com/yourusername/your-repository.git
   ```

2. **Navigate to the Project Directory:**

   ```bash
   cd your-repository
   ```

3. **Install Dependencies:**

   ```bash
   composer install
   ```

4. **Set Up Environment File:**

   Copy `.env.example` to `.env` and configure your database and other environment variables.

   ```bash
   cp .env.example .env
   ```

5. **Generate Application Key:**

   ```bash
   php artisan key:generate
   ```

6. **Run Migrations:**

   ```bash
   php artisan migrate
   ```

7. **Start the Development Server:**

   ```bash
   php artisan serve
   ```

## 💡 Contributing

Contributions are welcome! Please follow these steps:

1. Fork the repository.
2. Create a new branch for your feature or fix.
3. Make your changes and test thoroughly.
4. Submit a pull request with a clear description of your changes.

## 📜 License

This project is licensed under the [MIT License](LICENSE).

## 📬 Contact

For questions or support, please reach out to [abdogoda0a@gmail.com](mailto:abdogoda0a@gmail.com).

