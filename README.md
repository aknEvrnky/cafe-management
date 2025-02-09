# Cafe Management System

Modern ve kullanıcı dostu bir kafe menü yönetim sistemi.

## 🚀 Teknoloji Stack

### Backend
- **Laravel 11.x** - PHP Framework
- **PHP 8.4** - Programlama Dili
- **MySQL 8.0** - Veritabanı
- **Redis** - Cache ve Queue
- **Laravel Octane + Swoole** - Yüksek Performans Sunucu
- **Laravel Sanctum** - API Authentication
- **Pest PHP** - Modern Testing Framework

### Frontend
- **Vue.js 3.4** - Progressive JavaScript Framework
- **Inertia.js** - Modern Monolith Framework
- **Tailwind CSS 3.x** - Utility-first CSS Framework
- **Headless UI** - Unstyled UI Components
- **Heroicons** - Beautiful Icons
- **Vue Toastification** - Toast Notifications

### Development & Deployment
- **Docker & Laravel Sail** - Containerization
- **Vite** - Modern Frontend Tooling
- **Node.js 22** - JavaScript Runtime
- **Composer** - PHP Package Manager
- **npm** - Node Package Manager

## 🌟 Özellikler

- 🏪 Çoklu Kafe Yönetimi
- 📱 Responsive Tasarım
- 🎨 Modern ve Kullanıcı Dostu Arayüz
- 📸 Görsel Yükleme ve Yönetimi
- 🔍 Kategori ve Ürün Yönetimi
- 🔒 Güvenli Kullanıcı Yetkilendirme
- 📊 Menü Yönetimi
- 🌐 SEO Dostu URL Yapısı

## 🛠 Kurulum

1. Projeyi klonlayın:
```bash
git clone <repository-url>
cd cafe-management
```

2. Bağımlılıkları yükleyin:
```bash
composer install
npm install
```

3. Ortam değişkenlerini ayarlayın:
```bash
cp .env.example .env
php artisan key:generate
```

4. Veritabanını hazırlayın:
```bash
php artisan migrate
```

5. Geliştirme sunucusunu başlatın:
```bash
# Docker ile:
./vendor/bin/sail up -d

# veya lokal geliştirme için:
php artisan serve
npm run dev
```

## 🧪 Testler

Testleri çalıştırmak için:

```bash
php artisan test
# veya
./vendor/bin/pest
```

## 📝 Lisans

Bu proje MIT lisansı altında lisanslanmıştır. Detaylar için [LICENSE](LICENSE) dosyasına bakın.
