# GitHub Actions Deployment Setup

Simple automated deployment for vadmin-testsite on cPanel/WHM server.

## 🔑 Required GitHub Secrets

Go to your repository **Settings → Secrets and variables → Actions** and add:

| Secret Name | Description | Example |
|------------|-------------|---------|
| `SERVER_HOST` | Your server hostname or IP | `example.com` or `192.168.1.100` |
| `SERVER_USER` | cPanel/SSH username | `cpanelusername` |
| `SSH_PRIVATE_KEY` | SSH private key for authentication | See below |
| `APP_PATH` | Full path to your app on server | `/home/username/public_html/vadmin-testsite` |
| `SSH_PORT` | SSH port (optional, defaults to 22) | `22` |

## 🔐 Setting Up SSH Key

### 1. Generate SSH Key (on your local machine)

```bash
ssh-keygen -t ed25519 -C "github-deploy" -f ~/.ssh/github-deploy
```

### 2. Add Public Key to cPanel

**Option A: Via cPanel SSH Access Interface**
- Login to cPanel
- Go to **Security → SSH Access → Manage SSH Keys**
- Click "Import Key"
- Paste the public key content (from `~/.ssh/github-deploy.pub`)
- Authorize the key

**Option B: Via SSH**
```bash
cat ~/.ssh/github-deploy.pub | ssh user@yourserver.com "mkdir -p ~/.ssh && cat >> ~/.ssh/authorized_keys"
```

### 3. Test SSH Connection

```bash
ssh -i ~/.ssh/github-deploy user@yourserver.com "echo 'Connected successfully!'"
```

### 4. Add Private Key to GitHub

```bash
cat ~/.ssh/github-deploy
```

Copy the entire output (including BEGIN and END lines) and add it to GitHub Secrets as `SSH_PRIVATE_KEY`.

## 🚀 How It Works

When you push to the `main` branch:

1. ✅ Pulls latest code from GitHub
2. ✅ Installs npm dependencies
3. ✅ Builds React/Vite frontend assets
4. ✅ Clears Laravel cache
5. ✅ Done!

## 📝 Manual Deployment

You can trigger deployment manually:

1. Go to **Actions** tab
2. Select "Deploy to Production"
3. Click "Run workflow"
4. Click "Run workflow" button

## 🔍 Troubleshooting

### Deployment Fails - "Permission denied"
- Verify SSH key is added to cPanel
- Check SSH_PRIVATE_KEY secret is correct
- Test: `ssh -i ~/.ssh/github-deploy user@server`

### Deployment Fails - "npm: command not found"
- Install Node.js on your cPanel via SSH:
  ```bash
  # Using NVM (recommended)
  curl -o- https://raw.githubusercontent.com/nvm-sh/nvm/v0.39.0/install.sh | bash
  source ~/.bashrc
  nvm install 20
  nvm use 20
  ```

### Frontend Assets Not Building
- SSH into server manually
- Navigate to app directory
- Run: `cd resources/views/vadmin-react-vite && npm install && npm run build`

### Git Pull Fails
- Ensure git is configured on server
- Set up deploy key or use HTTPS with token

## 📍 Finding Your APP_PATH

SSH into your server and run:
```bash
pwd
```

Common cPanel paths:
- `/home/username/public_html/vadmin-testsite`
- `/home/username/domains/example.com/public_html`
- `/home/username/vadmin-testsite`

## ✅ First Time Setup Checklist

- [ ] SSH key generated and added to cPanel
- [ ] All GitHub secrets configured
- [ ] Node.js installed on server
- [ ] App repository cloned on server
- [ ] Test deployment workflow manually

