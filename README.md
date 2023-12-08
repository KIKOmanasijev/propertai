
# How to setup PropertAi
## Setup the .env variables
```
OPENAI_API_KEY=
```

## Run the following commands:

```
composer install
php artisan migrate
npm install
npm run dev 
```

### (optional) S3 Object storage
If you want to use S3 Object storage provider (such as Scaleway) for the app, then you should configure the following env variables.
```
MEDIA_DISK=object_storage
OBJECT_STORAGE_ACCESS_KEY_ID='access key id from your API key'
OBJECT_STORAGE_SECRET_ACCESS_KEY='secret key from your API key'
OBJECT_STORAGE_DEFAULT_REGION='region of your bucket'
OBJECT_STORAGE_BUCKET='your bucket name'
OBJECT_STORAGE_ENDPOINT='example for scaleway: s3.fr-par.scw.cloud'
OBJECT_STORAGE_USE_PATH_STYLE_ENDPOINT=true
```
