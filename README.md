Seller-based eCommerce MVC System 
#Project Overview
This project is a Seller-based eCommerce system built using the MVC (Model-View-Controller) architecture.
Sellers can register, login, add products, and view their sales history.
/seller_mvc
├── set.sql                      # Database creation & setup script
│
├── config/
│   └── database.php               # Database connection class
│
├── controllers/
│   ├── UserController.php      
│  
│
├── models/
│   ├── User.php                 # user model (database operations)
│   ├── Product.php                # Product model
│   └── Order.php                  # Order model
│
├── views/
│   ├── auth/
│   │   ├── login.php              # Seller login form
│   │   └── register.php           # Seller registration form
│       ├── dashboard.php          # Seller dashboard
└── public/
    ├── css/
    ├── js/
    └── uploads/                   # Product images uploaded here

Features:
         Seller registration & login
         Seller dashboard
         Add and list products
         View seller sales history
         MySQL with foreign keys and prepared statements
         Password hashing and secure sessions
