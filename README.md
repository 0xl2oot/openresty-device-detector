# OpenResty Device Detector Using [matomo-org/device-detector](https://github.com/matomo-org/device-detector)

## start

```shell
# clone this repo
git clone https://github.com/0xl2oot/openresty-device-detector.git

# cd php dir
cd openresty-device-detector/www
# install dependencies
composer install

cd ..
docker-compose up --build
```

## test

> print json by [jq](https://stedolan.github.io/jq/).

```shell
$ curl --location --request GET 'http://localhost:8088/agent' \
--header 'User-Agent: Mozilla/5.0 (Linux; U; Android 10; zh-Hans-CN; VCE-AL00 Build/HUAWEIVCE-AL00) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/57.0.2987.108 Quark/4.1.0.132 Mobile Safari/537.36' | jq .

{
  "userAgent": "Mozilla/5.0 (Linux; U; Android 10; zh-Hans-CN; VCE-AL00 Build/HUAWEIVCE-AL00) AppleWebKit/537.36 (KHTML, like Gecko) Version/4.0 Chrome/57.0.2987.108 Quark/4.1.0.132 Mobile Safari/537.36",
  "isBot": false,
  "botInfo": null,
  "clientInfo": {
    "type": "browser",
    "name": "Chrome Webview",
    "short_name": "CV",
    "version": "57.0.2987.108",
    "engine": "Blink",
    "engine_version": ""
  },
  "osInfo": {
    "name": "Android",
    "short_name": "AND",
    "version": "10",
    "platform": ""
  },
  "device": "smartphone",
  "brand": "Huawei",
  "model": "Nova 4"
}

$ curl --location --request GET 'http://localhost:8088/agent' \
--header 'User-Agent: Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.138 Safari/537.36' | jq .

{
  "userAgent": "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_4) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.138 Safari/537.36",
  "isBot": false,
  "botInfo": null,
  "clientInfo": {
    "type": "browser",
    "name": "Chrome",
    "short_name": "CH",
    "version": "81.0.4044.138",
    "engine": "Blink",
    "engine_version": ""
  },
  "osInfo": {
    "name": "Mac",
    "short_name": "MAC",
    "version": "10.15.4",
    "platform": ""
  },
  "device": "desktop",
  "brand": "Apple",
  "model": ""
}
```

