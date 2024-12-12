# WordPress with Docker, MariaDB, and Nginx Proxy Manager

This setup uses Docker Compose to create a WordPress environment with a MariaDB database and Nginx Proxy Manager for easy HTTPS configuration.

## Prerequisites

- [Docker](https://www.docker.com/products/docker-desktop)
- [Docker Compose](https://docs.docker.com/compose/install/)

## Getting Started

1. **Clone the repository:**

   ```bash
   git clone <your-repository-url>
   cd <repository-name>
   ```

2. **Create an `.env` file:**

   Create a `.env` file in the root of the project and set the following environment variables:

   ```
   MYSQL_ROOT_PASSWORD=your_root_password
   MYSQL_DATABASE=your_database_name
   MYSQL_USER=your_database_user
   MYSQL_PASSWORD=your_database_password
   ```

   Replace the placeholders with your desired values.

3. **Create `uploads.ini` file:**

   - Create a file named `uploads.ini` in the root of your project to configure custom PHP upload settings. For example:

   ```ini
   file_uploads = On
   memory_limit = 128M
   upload_max_filesize = 100M
   post_max_size = 100M
   max_execution_time = 600
   ```

4. **Start the containers:**

   ```bash
   docker compose up -d
   ```

5. **Configure Nginx Proxy Manager:**

   - Open your web browser and go to `http://localhost:81`.
   - Log in with the default credentials:
     - **Email:** `admin@example.com`
     - **Password:** `changeme`
   - Change your default email and password.
   - Go to **Hosts -> Proxy Hosts**.
   - Click **Add Proxy Host**.
   - **Domain Names:**
     - **Development:** Enter a domain name like `your-site.local`. You might need to add this to your `/etc/hosts` file pointing to `127.0.0.1`.
     - **Production:** Enter your actual domain name.
   - **Forward Hostname / IP:** `wordpress`
   - **Forward Port:** `80`
   - **SSL Tab:**
     - **Development:** You can choose "Request a new SSL certificate with Let's Encrypt" for a self-signed certificate or "None" to use HTTP.
     - **Production:** Choose "Request a new SSL certificate with Let's Encrypt".
     - Enable "Force SSL" and other security options as needed.
     - Enter your email address.
     - Click "Save."

6. **Access WordPress:**

   - **Development:** `http://your-site.local` (or `https://your-site.local` if you set up a self-signed certificate).
   - **Production:** `https://your-domain.com`

   You should now be able to access the WordPress installation wizard.

## Optional:

- **Tailwind CSS:** [https://tailwindcss.com/](https://tailwindcss.com/)
- **Shadcn UI:** [https://ui.shadcn.com/](https://ui.shadcn.com/)

## Notes

- If you are using this setup for local development, you might need to add `your-site.local` (or your chosen domain name) to your computer's `/etc/hosts` file, pointing it to `127.0.0.1`.
- For production, make sure your DNS records are configured to point your domain name to your server's IP address.

--

# Structure

.
├── db_data/
├── nginx_proxy_manager/
│ ├── data/
│ └── letsencrypt/
├── wordpress/
├── .env
├── docker-compose.yml
├── README.md
└── uploads.ini
