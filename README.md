# IPExpense - Personal Expense Tracker

**IPExpense** is a personal expense tracker web application built with Laravel and Blade templating engine. The app allows users to manage their income, expenses, budgets, categories, and recurring transactions with an easy-to-use interface. It features dynamic list and card views, providing a flexible and interactive user experience.

## Features

- **Expense Management**: Track your daily expenses by category, amount, date, and description.
- **Income Management**: Keep track of all your income sources and amounts.
- **Budgets**: Set budgets for different categories and monitor spending against them.
- **Recurring Transactions**: Manage recurring expenses and income with customizable frequencies.
- **Categories**: Define and organize categories for both income and expenses.
- **Dynamic Views**: Switch between list and card views for a more flexible display of data.
- **Responsive Design**: A user-friendly interface that works seamlessly on desktop and mobile devices.

## Installation

### Prerequisites

- PHP 8.1 or higher
- Composer
- Laravel 9.x
- PostgreSQL or any other compatible database
- Node.js and npm (for frontend dependencies)

### Steps

1. **Clone the repository:**

    ```bash
    git clone https://github.com/ipcompscience/ipexpense.git
    cd ipexpense
    ```

2. **Install dependencies:**

    ```bash
    composer install
    npm install
    npm run build
    ```

3. **Set up your environment:**

    Copy the `.env.example` file to `.env` and update the database and other configuration details:

    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4. **Migrate the database:**

    Run the migrations to set up the database tables:

    ```bash
    php artisan migrate
    ```

5. **Serve the application:**

    Start the development server:

    ```bash
    php artisan serve
    ```

    The application will be accessible at `http://127.0.0.1:8000`.

## Usage

1. **Register** a new account or **login** with existing credentials.
2. Add your **income**, **expenses**, and manage your **budgets** and **categories**.
3. Set up **recurring transactions** for regular expenses or income.
4. Use the **dynamic view toggle** to switch between card and list views for your records.

## Technology Stack

- **Backend**: Laravel 9.x (PHP Framework)
- **Frontend**: Blade templating, Bootstrap 4.5, Chart.js
- **Database**: PostgreSQL (or any other compatible database)
- **Authentication**: Laravel Breeze

## Screenshots

![Dashboard Screenshot](https://ipdev-portfolio.s3.us-west-1.amazonaws.com/ipexpense_screenshot.png)

## Contributing

If you'd like to contribute to the development of IPExpense, feel free to fork the repository and submit a pull request.

1. Fork the repository
2. Create your feature branch (`git checkout -b feature/new-feature`)
3. Commit your changes (`git commit -m 'Add new feature'`)
4. Push to the branch (`git push origin feature/new-feature`)
5. Open a pull request

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Contact

For any inquiries or feedback, please contact:

- **Isak Park**: [ipcompscience@gmail.com](mailto:ipcompscience@gmail.com)

---

Made with ❤️ by [Isak Park]
