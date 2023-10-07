## How to use

Here are the stepsto use and run this project

1. Fork this repository
2. Clone your repository

```bash
git clone https://github.com/[USERNAME]/eventmu.git
```

3. Install composer's dependecy

```bash
composer install
```

4. Set up your project environtment

```bash
cp .env.example .env
php artisan key:generate
```

5. Run Migration and Seeding

```bash
php artisan migrate --seed
```

6. Run the project

```bash
php artisan serve
```

## Contributing

Here are the steps to develop new features and contribute to this project.

1. Fork this repository
2. Clone your fork
3. Do some works
4. Clean your work using lint

```
./vendor/bin/pint
```

5. Checkout to new branch

```bash
git branch YOUR-NEW-FEATURE
git checkout YOUR-NEW-FEATURE
```

6. Commit

```bash
git init
git add .
git commit -m "[Your message] #[YOUR ISSUE NUMBER]"
```

7. Push your work to github

```bash
git push -u origin --set-upstream YOUR-NEW-FEATURE
```

8. Go to your [github](https://github.com) account and make pull request from your fork and branch, and marge to our MAIN upstream
