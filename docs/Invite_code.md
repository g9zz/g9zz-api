## 邀请码

* [邀请码列表](#邀请码列表)
* [邀请码创建](#邀请码创建)
* [自己邀请码总数](#自己邀请码总数)


### code

#### 邀请码列表

- PATH `console/code`
- METHOD `GET`
- PARAMS

| request        | param    |  note  | other |
| --------   | -----:   | :----: | ---- |
|status|`created`,`used`,`obsolete`| 状态 | |
|orderId|`desc`,`asc`|id排序||

- RESPONSE
```json
{
  "code": 0,
  "message": "成功",
  "data": [
    {
      "id": 1,
      "status": "created",
      "obsoletedAt": "2017-05-19T01:59:15+00:00",
      "code": "e97a87db-eea8-3f3e-a977-52c8c528bcb8",
      "url": "http://localhost/register?source=e97a87db-eea8-3f3e-a977-52c8c528bcb8",
      "inviter": {
        "id": 1,
        "name": "叶落山城秋",
        "avatar": "https://image.baidu.com/search/detail?ct=503316480&z=undefined&tn=baiduimagedetail&ipn=d&word=宠物&step_word=&ie=utf-8&in=&cl=2&lm=-1&st=undefined&cs=2911900371,4188553288&os=2777149326,2467460676&simid=80045321,1051818213&pn=3&rn=1&di=188983409670&ln=1986&"
      }
    },
    {
      "id": 2,
      "status": "created",
      "obsoletedAt": "2017-05-19T01:59:47+00:00",
      "code": "b71f7e30-0576-345f-9839-b125de9c2801",
      "url": "http://localhost/register?source=b71f7e30-0576-345f-9839-b125de9c2801",
      "inviter": {
        "id": 1,
        "name": "叶落山城秋",
        "avatar": "https://image.baidu.com/search/detail?ct=503316480&z=undefined&tn=baiduimagedetail&ipn=d&word=宠物&step_word=&ie=utf-8&in=&cl=2&lm=-1&st=undefined&cs=2911900371,4188553288&os=2777149326,2467460676&simid=80045321,1051818213&pn=3&rn=1&di=188983409670&ln=1986&"
      }
    },
    {
      "id": 3,
      "status": "created",
      "obsoletedAt": "2017-05-19T02:00:20+00:00",
      "code": "f51159b3-861c-3c1d-8a2f-e09f1ff346ab",
      "url": "http://localhost/register?source=f51159b3-861c-3c1d-8a2f-e09f1ff346ab",
      "inviter": {
        "id": 1,
        "name": "叶落山城秋",
        "avatar": "https://image.baidu.com/search/detail?ct=503316480&z=undefined&tn=baiduimagedetail&ipn=d&word=宠物&step_word=&ie=utf-8&in=&cl=2&lm=-1&st=undefined&cs=2911900371,4188553288&os=2777149326,2467460676&simid=80045321,1051818213&pn=3&rn=1&di=188983409670&ln=1986&"
      }
    },
    {
      "id": 4,
      "status": "created",
      "obsoletedAt": "2017-05-19T02:00:45+00:00",
      "code": "840602a7-405f-3440-b6d1-6d6f7890f90e",
      "url": "http://localhost/register?source=840602a7-405f-3440-b6d1-6d6f7890f90e",
      "inviter": {
        "id": 1,
        "name": "叶落山城秋",
        "avatar": "https://image.baidu.com/search/detail?ct=503316480&z=undefined&tn=baiduimagedetail&ipn=d&word=宠物&step_word=&ie=utf-8&in=&cl=2&lm=-1&st=undefined&cs=2911900371,4188553288&os=2777149326,2467460676&simid=80045321,1051818213&pn=3&rn=1&di=188983409670&ln=1986&"
      }
    },
    {
      "id": 5,
      "status": "created",
      "obsoletedAt": "2017-05-19T03:54:36+00:00",
      "code": "f2bbe4f6-846e-32d2-89a9-4dbd5cd7e72f",
      "url": "http://localhost/register?source=f2bbe4f6-846e-32d2-89a9-4dbd5cd7e72f",
      "inviter": {
        "id": 1,
        "name": "叶落山城秋",
        "avatar": "https://image.baidu.com/search/detail?ct=503316480&z=undefined&tn=baiduimagedetail&ipn=d&word=宠物&step_word=&ie=utf-8&in=&cl=2&lm=-1&st=undefined&cs=2911900371,4188553288&os=2777149326,2467460676&simid=80045321,1051818213&pn=3&rn=1&di=188983409670&ln=1986&"
      }
    }
  ],
  "pager": {
    "entities": 5,
    "current": 1,
    "total": 1,
    "limit": 20,
    "last": 1,
    "next": "",
    "previous": ""
  }
}
```

#### 邀请码创建

- PATH `console/code`
- METHOD `POST`
- PARAMS

| request        | param    |  note  | other |
| --------   | -----:   | :----: | ---- |
|||||

- RESPONSE
```json
{
  "code": 0,
  "message": "成功",
  "data": {
    "url": "http://localhost/register?source=dc9ed47c-a70d-3ca4-9979-7de6773398e7"
  }
}
```

#### 自己邀请码总数

- PATH `console/code/allCode`
- METHOD `GET`
- PARAMS

| request        | param    |  note  | other |
| --------   | -----:   | :----: | ---- |
|||||

- RESPONSE
```json
{
  "code": 0,
  "message": "成功",
  "data": [
    {
      "id": 2,
      "status": "created",
      "obsoletedAt": "2017-05-19T01:59:47+00:00",
      "code": "b71f7e30-0576-345f-9839-b125de9c2801",
      "url": "http://localhost/register?source=b71f7e30-0576-345f-9839-b125de9c2801",
      "inviter": {
        "id": 1,
        "name": "叶落山城秋",
        "avatar": "https://image.baidu.com/search/detail?ct=503316480&z=undefined&tn=baiduimagedetail&ipn=d&word=宠物&step_word=&ie=utf-8&in=&cl=2&lm=-1&st=undefined&cs=2911900371,4188553288&os=2777149326,2467460676&simid=80045321,1051818213&pn=3&rn=1&di=188983409670&ln=1986&"
      }
    },
    {
      "id": 3,
      "status": "created",
      "obsoletedAt": "2017-05-19T02:00:20+00:00",
      "code": "f51159b3-861c-3c1d-8a2f-e09f1ff346ab",
      "url": "http://localhost/register?source=f51159b3-861c-3c1d-8a2f-e09f1ff346ab",
      "inviter": {
        "id": 1,
        "name": "叶落山城秋",
        "avatar": "https://image.baidu.com/search/detail?ct=503316480&z=undefined&tn=baiduimagedetail&ipn=d&word=宠物&step_word=&ie=utf-8&in=&cl=2&lm=-1&st=undefined&cs=2911900371,4188553288&os=2777149326,2467460676&simid=80045321,1051818213&pn=3&rn=1&di=188983409670&ln=1986&"
      }
    },
    {
      "id": 4,
      "status": "created",
      "obsoletedAt": "2017-05-19T02:00:45+00:00",
      "code": "840602a7-405f-3440-b6d1-6d6f7890f90e",
      "url": "http://localhost/register?source=840602a7-405f-3440-b6d1-6d6f7890f90e",
      "inviter": {
        "id": 1,
        "name": "叶落山城秋",
        "avatar": "https://image.baidu.com/search/detail?ct=503316480&z=undefined&tn=baiduimagedetail&ipn=d&word=宠物&step_word=&ie=utf-8&in=&cl=2&lm=-1&st=undefined&cs=2911900371,4188553288&os=2777149326,2467460676&simid=80045321,1051818213&pn=3&rn=1&di=188983409670&ln=1986&"
      }
    },
    {
      "id": 5,
      "status": "created",
      "obsoletedAt": "2017-05-19T03:54:36+00:00",
      "code": "f2bbe4f6-846e-32d2-89a9-4dbd5cd7e72f",
      "url": "http://localhost/register?source=f2bbe4f6-846e-32d2-89a9-4dbd5cd7e72f",
      "inviter": {
        "id": 1,
        "name": "叶落山城秋",
        "avatar": "https://image.baidu.com/search/detail?ct=503316480&z=undefined&tn=baiduimagedetail&ipn=d&word=宠物&step_word=&ie=utf-8&in=&cl=2&lm=-1&st=undefined&cs=2911900371,4188553288&os=2777149326,2467460676&simid=80045321,1051818213&pn=3&rn=1&di=188983409670&ln=1986&"
      }
    },
    {
      "id": 6,
      "status": "created",
      "obsoletedAt": "2017-05-19T04:41:03+00:00",
      "code": "dc9ed47c-a70d-3ca4-9979-7de6773398e7",
      "url": "http://localhost/register?source=dc9ed47c-a70d-3ca4-9979-7de6773398e7",
      "inviter": {
        "id": 1,
        "name": "叶落山城秋",
        "avatar": "https://image.baidu.com/search/detail?ct=503316480&z=undefined&tn=baiduimagedetail&ipn=d&word=宠物&step_word=&ie=utf-8&in=&cl=2&lm=-1&st=undefined&cs=2911900371,4188553288&os=2777149326,2467460676&simid=80045321,1051818213&pn=3&rn=1&di=188983409670&ln=1986&"
      }
    }
  ]
}
```