# lbwa

### static files that need to be created before
```
/storage/app/public/cms/en/contact/address.html
/storage/app/public/cms/en/contact/content.html
/storage/app/public/cms/pl/contact/address.html
/storage/app/public/cms/pl/contact/content.html
```

### permission must be granted for directories
```
/storage
/public/project_files
```

### symlink needs to be created (php artisan storage:link)
```
/storage/app/public to /public/storage
```