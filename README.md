# Acme Widget Co - Coding Test

A simple PHP project to demonstrate basket calculation logic for an e-commerce scenario. This coding test implements a shopping basket with product offers and delivery rules, using modern PHP and Composer for dependency management. The project is containerized with Docker for easy setup and portability.

## Technologies Used

- **PHP 8.2**
- **Composer** (dependency management)
- **PHPUnit** (unit testing)
- **Docker** (containerized environment)

## Features

- Add products to a basket by code
- Calculate basket total with offers and delivery rules
- "Buy One, Get One Half Price" offer for selected products
- Delivery cost rules based on basket subtotal
- Error handling for invalid product codes
- Unit tests for all main scenarios
- CLI tool to calculate basket totals from product codes

## Setup

> This project uses Docker for easy setup and environment isolation.

### 1. Clone the repository

```bash
git clone https://github.com/dgbusiness/acme-widget-co.git
cd acme-widget-co
```

### 2. Build and run containers

```bash
docker compose up -d --build
```

### 3. Install PHP dependencies inside the container

```bash
docker exec acme-wiget-co-app composer install
```

## Usage

### Calculate basket total from the command line

You can use the custom CLI tool to calculate the total for any combination of product codes:

```bash
docker exec acme-wiget-co-app composer basket B01,G01
```

Replace `B01,G01` with any comma-separated list of product codes.

### Example baskets

| Products              | Total   |
|-----------------------|---------|
| B01,G01               | $37.85  |
| R01,R01               | $54.37  |
| R01,G01               | $60.85  |
| B01,B01,R01,R01,R01   | $98.27  |

### Run tests

To run all unit tests:

```bash
docker exec acme-wiget-co-app composer test
```

## Product Catalogue

- **R01** – Red Widget – $32.95
- **G01** – Green Widget – $24.95
- **B01** – Blue Widget – $7.95

## Offers

- **BogoHalfPrice:** Buy one, get one half price on Red Widget (R01).

## Delivery Rules

- Orders under $50: $4.95 delivery
- Orders $50–$90: $2.95 delivery
- Orders over $90: Free delivery

## Assumptions

- The "Buy One, Get One Half Price" offer is applied every time the quantity of the target product is a multiple of 2 (i.e., for each pair, the second item is half price).
- For this coding test, arrays are used to represent products, delivery rules, and offers. In a production environment, these would typically be managed using a database or persistent storage.
- Product codes provided to the CLI tool must match exactly those defined in the catalogue; invalid codes will result in an error.
- All monetary calculations are truncated (not rounded) to two decimal places to avoid rounding errors.
- The CLI tool expects a single argument: a comma-separated list of product codes (no spaces).
- The delivery cost is determined after discounts are applied to the basket subtotal.

---

**Author:** Dgbusiness  
**Email:** dgbusiness26@gmail.com