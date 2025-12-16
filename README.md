# docker-mediawiki

A dockerized MediaWiki installation with custom configuration and extensions.

## Overview

This repository contains a Docker-based MediaWiki setup with MySQL database, custom extensions, and the Timeless skin.

## Prerequisites

- Docker
- Docker Compose
- Git

## Quick Start

1. **Clone the repository**
   ```bash
   git clone <repository-url>
   cd docker-mediawiki
   ```

2. **Configure environment variables**
   
   Create a `.env` file in the project root with the following variables:
   
   ```bash
   # Source Database Configuration (for dump-downloader)
   SOURCE_DB_HOST=your-source-mysql-host
   SOURCE_DB_USER=your-source-db-user
   SOURCE_DB_PASSWORD=your-source-db-password
   SOURCE_DB_NAME=your-source-db-name

   # OpenID Connect Configuration
   OPENID_TENANT_ID=your-tenant-id
   OPENID_CLIENT_ID=your-client-id
   SOURCE_CLIENT_SECRET=your-client-secret

   # MediaWiki Secret Key
   SOURCE_MEDIAWIKI_SECRET_KEY=your-secret-key

   # Local MySQL Root Password
   MYSQL_ROOT_PASSWORD=your-root-password
   ```
   
   **Note:** Never commit the `.env` file to Git. A `.env.example` file is provided as a template.
   **Note:** Most of them avalaible in the rancher storage.

3. **Start the containers**
   ```bash
   docker-compose up -d
   ```

4. **Access MediaWiki**
   
   Open your browser and navigate to `http://localhost:9000` (or the configured port in [docker-compose.yml](docker-compose.yml))
