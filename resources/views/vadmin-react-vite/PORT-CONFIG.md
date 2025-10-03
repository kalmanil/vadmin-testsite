# Port Configuration Guide

## 🔧 Current Setup
- **Default Port:** `5174`
- **Configurable:** Yes, via environment variables
- **Range:** Any available port (1024-65535 recommended)

## 🎯 How to Change the Port

### Method 1: Laravel Environment Variable
Add to your main Laravel `.env` file:
```env
VITE_DEV_PORT=3000
```

### Method 2: Local Environment File
Create `resources/views/vadmin-react-vite/.env`:
```env
VITE_DEV_PORT=3000
```

### Method 3: Command Line Override
```bash
# Temporary override
VITE_DEV_PORT=3000 npm run dev

# Or with cross-env (install with: npm install --save-dev cross-env)
cross-env VITE_DEV_PORT=3000 npm run dev
```

### Method 4: Package.json Scripts
Update `package.json`:
```json
{
  "scripts": {
    "dev": "cross-env VITE_DEV_PORT=3000 vite",
    "dev:3000": "cross-env VITE_DEV_PORT=3000 vite",
    "dev:8080": "cross-env VITE_DEV_PORT=8080 vite"
  }
}
```

## 📋 Popular Port Choices
- **3000** - Common React development port
- **8080** - Traditional web development port  
- **4000** - Alternative development port
- **5173** - Default Vite port
- **5174** - Current default (to avoid conflicts)

## ⚙️ What Gets Updated Automatically
When you change `VITE_DEV_PORT`:
- ✅ Vite dev server port
- ✅ HMR (Hot Module Replacement) port
- ✅ Laravel Blade template detection
- ✅ Error messages and instructions
- ✅ Browser console logs

## 🚨 Port Conflicts
If you get "port already in use" errors:
```bash
# Check what's using the port
netstat -ano | findstr :5174

# Kill process (Windows)
taskkill /PID <process_id> /F

# Or just use a different port
VITE_DEV_PORT=5175 npm run dev
```

## 🔄 Multiple Projects
Run multiple VAdmin instances:
```bash
# Project 1
cd project1/resources/views/vadmin-react-vite
VITE_DEV_PORT=5174 npm run dev

# Project 2  
cd project2/resources/views/vadmin-react-vite
VITE_DEV_PORT=5175 npm run dev
```

## 🎯 Recommendation
- **Development:** Use `3000` or `5174` (current default)
- **Team work:** Document chosen port in README
- **CI/CD:** Use environment variables for flexibility
