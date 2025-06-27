# ইনস্টলেশন ধাপ:
ব্যাকএন্ড ফোল্ডারে:
bash




composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
ফ্রন্টএন্ড ফোল্ডারে:
bash




npm install
npm run dev
