# WordPress Development Environment

This project runs in a **dev container**: a full, working WordPress site packaged with Docker, with the editor, database and tools already set up. Open the folder in VS Code, click **Reopen in Container**, and within a few minutes you have a running site you can edit, debug and query. You don't need to install PHP, Apache, MySQL or anything else on your own machine.

## Why a dev container?

| Without a dev container | With this dev container |
| --- | --- |
| Install and configure PHP, a web server and a database yourself | Everything is defined in `.devcontainer/` and built for you |
| "Works on my machine" differences between developers | Everyone runs the same versions: WordPress 7.1.5, PHP 8.3 and MariaDB 11 |
| Set up editor extensions and debugging by hand | VS Code extensions and Xdebug step debugging work out of the box |
| Local installs clutter your machine and can conflict with other projects | Everything is isolated in containers and removed cleanly when you're done |
| Test against a mocked or partial setup | Develop against a real, running WordPress site with a real database |

New developers can go from cloning the repo to a working site in one step, and existing developers can rebuild a clean environment whenever they need to.

## What's included

The setup lives in [`.devcontainer/`](.devcontainer/) and runs three services:

| Service | Purpose | Address |
| --- | --- | --- |
| **WordPress** | WordPress 7.1.5 on PHP 8.3 and Apache, with OPcache, Xdebug and WP-CLI | http://localhost:8080 |
| **MariaDB 11** | The site database, stored in a persistent Docker volume | `db:3306` (inside the container) |
| **phpMyAdmin** | Browse and edit the database in your browser | http://localhost:8081 |

### How the files fit together

This project only holds what is specific to this site. **WordPress core comes from the Docker image**, so you never have to download, update or keep track of core files yourself.

| Location in the container | What it is | Where it comes from |
| --- | --- | --- |
| `/workspace` | This project, where VS Code opens | Your project folder |
| `/var/www/html` | The running site (the web root) | WordPress 7.1.5 core from the image |
| `/var/www/html/wp-content` | Themes, plugins and uploads | Your project's `wp-content/` |
| `/var/www/html/wp-config.php` | Site configuration | Your project's `wp-config.php` |
| `/var/www/html/.htaccess` | Rewrite rules | Your project's `.htaccess` |

Because `wp-content`, `wp-config.php` and `.htaccess` are shared straight from your project, any change you make in the editor shows up on the running site right away. You don't need to build or deploy anything.

**To upgrade WordPress**, change the version tag in `wordpress.Dockerfile` and rebuild the container. The rebuild replaces core with a clean copy of the new version.

### Configuration files

| File | What it does |
| --- | --- |
| `devcontainer.json` | Defines the dev container: VS Code extensions, forwarded ports and the Claude Code setup |
| `docker-compose.yml` | Defines the WordPress, MariaDB and phpMyAdmin services |
| `wordpress.Dockerfile` | The WordPress image, pinned to `wordpress:7.1.5-php8.3-apache`, with WP-CLI and Xdebug added |
| `php.ini` | PHP settings for development: higher memory and upload limits, errors logged to the container output |
| `xdebug.ini` | Xdebug settings: step debugging on port 9003 |
| `mysql.cnf` | MariaDB settings tuned for speed in development (not for production) |
| `.env` | Database credentials, created from `.env.example` |
| `../wp-cli.yml` | Points WP-CLI at the site in `/var/www/html` |
| `../.vscode/launch.json` | The Xdebug debug configuration, with path mappings from `/var/www/html` to `/workspace` |

## Getting started

1. Install [Docker Desktop](https://www.docker.com/products/docker-desktop/) (with WSL 2 on Windows) and [VS Code](https://code.visualstudio.com/) with the **Dev Containers** extension.
2. Copy `.devcontainer/.env.example` to `.devcontainer/.env` and set the database credentials.
3. Open the project folder in VS Code and choose **Dev Containers: Reopen in Container** from the command palette.
4. When the container is ready, open http://localhost:8080 for the site and http://localhost:8081 for phpMyAdmin.

When you close VS Code, the containers stop. The database is kept in a Docker volume, so your data is still there the next time you open the project.

## Built-in tools

- **WP-CLI**: run `wp` in the VS Code terminal to manage the site, for example `wp cache flush`, `wp user list` or `wp search-replace`. The `wp-cli.yml` file in the project points it at the site, so it works from `/workspace`.
- **Database client**: `mysql` / `mariadb` are available in the terminal, and `wp db query "..."` runs SQL directly.
- **PHP tooling**: IntelliSense and Composer support are installed through the VS Code extensions.
- **Xdebug step debugging**: open the **Run and Debug** panel, start **Listen for Xdebug**, set a breakpoint and load a page (or run a `wp` command). Every request tries to connect to the debugger. When nothing is listening, PHP carries on as normal.
- **Front-end tooling**: ESLint and Prettier are included.

## AI-assisted development with Claude

The dev container comes with **[Claude Code](https://claude.com/claude-code)** built in. The VS Code extension is installed automatically, and your existing Claude login and settings are shared into the container (read-only, through `~/.claude`), so it works without any extra setup.

What makes this useful is that Claude runs **inside the same environment as the site**, not in a separate chat window with only the snippets you paste in. That means Claude has:

- **Full access to the source code** of every plugin and theme in `wp-content/`, as well as WordPress core at `/var/www/html` for reference (changes to core are thrown away on rebuild). It can read, search and change code across the whole project, follow a hook from where it is registered to where it runs, and understand how the pieces fit together.
- **Direct access to the database.** Claude can run SQL through `wp db query` or the `mysql` client to inspect options, posts, post meta, users and custom tables. It sees the real data the site is using, so it doesn't have to guess.
- **A working site to test against.** Claude can use WP-CLI, read the PHP error log and request pages from the running site to check that a change actually works.

### Why this matters

Developing against a live, working system closes the loop between "write code" and "check it works":

- **Debugging is faster.** Ask *"Why isn't this product showing on the shop page?"* and Claude can trace the template, check the relevant hooks and query the database for the product's status and meta, all in one go.
- **Answers are grounded in your actual code and data**, not general WordPress advice.
- **Changes can be checked immediately.** Claude can make an edit, flush the cache, reload the page or re-run the query, and confirm the result.
- **Getting to know an unfamiliar codebase is easier.** New developers can ask Claude how a plugin or theme works and get answers based on the real source.

### Example prompts

- "Find where the checkout page template is overridden and explain what it changes."
- "Which plugin registers the `save_post` hook that updates stock levels?"
- "Query the database for all orders from the last 7 days that are still pending."
- "Show me which options this theme stores in `wp_options` and their current values."

> **Note:** This environment is for development only. The database in the container is a local copy, so Claude (and you) can experiment freely without affecting the live site. Even so, review changes before committing or deploying them.
