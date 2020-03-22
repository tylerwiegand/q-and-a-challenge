---
title: API Reference

language_tabs:
- bash
- javascript

includes:

search: true

toc_footers:
- <a href='http://github.com/mpociot/documentarian'>Documentation Powered by Documentarian</a>
---
<!-- START_INFO -->
# Info

Welcome to the generated API reference.
[Get Postman Collection](http://localhost:8080/docs/collection.json)

<!-- END_INFO -->

#Answers


<!-- START_20ff5884698206eb6955b67989e1e1c3 -->
## Request paginated list of Answers

> Example request:

```bash
curl -X GET \
    -G "http://localhost:8080/answers" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8080/answers"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "question_id": 411,
            "answer": "Nisi fugiat magnam adipisci eum aut doloremque.",
            "tags": [
                "nam",
                "repellendus",
                "quisquam",
                "nemo"
            ]
        },
        {
            "id": 2,
            "question_id": 651,
            "answer": "Facilis praesentium repellendus architecto optio in.",
            "tags": [
                "nam",
                "maiores",
                "eaque",
                "aperiam"
            ]
        },
        {
            "id": 3,
            "question_id": 306,
            "answer": "Est dolores cumque repellendus molestiae beatae ut a sit. Numquam aut velit similique laboriosam.",
            "tags": [
                "deleniti",
                "ab",
                "aliquid"
            ]
        },
        {
            "id": 4,
            "question_id": 187,
            "answer": "Dolorem magnam debitis hic ut eos aliquid.",
            "tags": [
                "eos",
                "debitis",
                "velit"
            ]
        },
        {
            "id": 5,
            "question_id": 91,
            "answer": "A eum enim neque consequuntur.",
            "tags": [
                "modi",
                "quos"
            ]
        }
    ],
    "first_page_url": "http:\/\/localhost:8080\/answers?page=1",
    "from": 1,
    "last_page": 5,
    "last_page_url": "http:\/\/localhost:8080\/answers?page=5",
    "next_page_url": "http:\/\/localhost:8080\/answers?page=2",
    "path": "http:\/\/localhost:8080\/answers",
    "per_page": 20,
    "prev_page_url": null,
    "to": 20,
    "total": 100
}
```

### HTTP Request
`GET answers`


<!-- END_20ff5884698206eb6955b67989e1e1c3 -->

<!-- START_9029fcfd53c4bb45b3ae2ec656a3caaf -->
## Create an Answer and store it

> Example request:

```bash
curl -X POST \
    "http://localhost:8080/answers" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"question_id":"et","answer":"pariatur","tags":"earum"}'

```

```javascript
const url = new URL(
    "http://localhost:8080/answers"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "question_id": "et",
    "answer": "pariatur",
    "tags": "earum"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (201):

```json
{
    "question_id": "1",
    "answer": "Love is food.",
    "tags": [
        "tempora",
        "mushroom",
        "beans"
    ],
    "id": 101
}
```

### HTTP Request
`POST answers`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `question_id` | required |  optional  | Accepts only an existing ID (integer) in the questions table.
        `answer` | required |  optional  | Accepts a string greater than 5 but less than 3000 characters long.
        `tags` | optional |  optional  | Accepts a comma delimited string greater than 5 but less than 3000 characters long.
    
<!-- END_9029fcfd53c4bb45b3ae2ec656a3caaf -->

#Questions


<!-- START_a9a49346cf9a2702ada9239063b41859 -->
## Request paginated list of Questions

> Example request:

```bash
curl -X GET \
    -G "http://localhost:8080/questions?sortBy=rem&sortDirection=suscipit" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json"
```

```javascript
const url = new URL(
    "http://localhost:8080/questions"
);

let params = {
    "sortBy": "rem",
    "sortDirection": "suscipit",
};
Object.keys(params)
    .forEach(key => url.searchParams.append(key, params[key]));

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

fetch(url, {
    method: "GET",
    headers: headers,
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (200):

```json
{
    "current_page": 1,
    "data": [
        {
            "id": 1,
            "slug": "blanditiis_voluptate",
            "question": "Blanditiis voluptate laudantium est minus accusantium. Mollitia et qui totam sit temporibus dolor omnis. Vel quia consequuntur sunt non?",
            "rank": 60,
            "answers": []
        },
        {
            "id": 2,
            "slug": "et_voluptas_est_libe",
            "question": "Et voluptas est libero distinctio modi dolor. Voluptate corporis aut alias et. Eaque perspiciatis sunt incidunt ratione omnis et?",
            "rank": 10,
            "answers": []
        },
        {
            "id": 3,
            "slug": "ut_quaerat_voluptas",
            "question": "Ut quaerat voluptas dicta ea nihil ut. Labore dolores mollitia omnis velit delectus. Tenetur assumenda ducimus suscipit dolor occaecati?",
            "rank": 18,
            "answers": [
                {
                    "id": 35,
                    "question_id": 3,
                    "answer": "Quia quaerat dolorum aut molestiae qui quasi delectus. Molestiae repudiandae eligendi magni ratione repellat consectetur quaerat. Vero autem ex praesentium dolor sint modi.",
                    "tags": [
                        "rem"
                    ]
                }
            ]
        },
        {
            "id": 4,
            "slug": "illum_corporis_quasi",
            "question": "Illum corporis quasi et animi omnis magni quia veritatis. Corporis repudiandae rerum rerum veniam. Explicabo perferendis dicta voluptatem numquam iste?",
            "rank": 45,
            "answers": []
        },
        {
            "id": 19,
            "slug": "tempore_velit_blandi",
            "question": "Tempore velit blanditiis architecto consectetur voluptatem. Nemo consequuntur nihil reprehenderit id aliquid aliquid. Quia atque sit quod molestiae earum?",
            "rank": 35,
            "answers": []
        },
        {
            "id": 20,
            "slug": "et_nesciunt_modi_qui",
            "question": "Et nesciunt modi quia error. Sed molestiae nemo corporis quam aut. Ratione maxime hic nihil?",
            "rank": 45,
            "answers": [
                {
                    "id": 28,
                    "question_id": 20,
                    "answer": "Distinctio consectetur architecto quos at illum odit. Qui atque repellendus optio ut labore consequuntur eos omnis.",
                    "tags": [
                        "et",
                        "est",
                        "quidem",
                        "dicta",
                        "corrupti"
                    ]
                }
            ]
        }
    ],
    "first_page_url": "http:\/\/localhost:8080\/questions?page=1",
    "from": 1,
    "last_page": 50,
    "last_page_url": "http:\/\/localhost:8080\/questions?page=50",
    "next_page_url": "http:\/\/localhost:8080\/questions?page=2",
    "path": "http:\/\/localhost:8080\/questions",
    "per_page": 20,
    "prev_page_url": null,
    "to": 20,
    "total": 1000
}
```

### HTTP Request
`GET questions`

#### Query Parameters

Parameter | Status | Description
--------- | ------- | ------- | -----------
    `sortBy` |  optional  | optional Sort by anything, only 'rank' currently supported.
    `sortDirection` |  optional  | optional Sort direction, ASC (default) or DESC.

<!-- END_a9a49346cf9a2702ada9239063b41859 -->

<!-- START_a686c2d54be536fb3d5e4ad3a0bca081 -->
## Create a Question and store it

> Example request:

```bash
curl -X POST \
    "http://localhost:8080/questions" \
    -H "Content-Type: application/json" \
    -H "Accept: application/json" \
    -d '{"question":"est"}'

```

```javascript
const url = new URL(
    "http://localhost:8080/questions"
);

let headers = {
    "Content-Type": "application/json",
    "Accept": "application/json",
};

let body = {
    "question": "est"
}

fetch(url, {
    method: "POST",
    headers: headers,
    body: body
})
    .then(response => response.json())
    .then(json => console.log(json));
```


> Example response (201):

```json
{
    "question": "What is love?",
    "rank": 102,
    "slug": "what_is_love",
    "id": 1002
}
```

### HTTP Request
`POST questions`

#### Body Parameters
Parameter | Type | Status | Description
--------- | ------- | ------- | ------- | -----------
    `question` | required |  optional  | Accepts a string greater than 5 but less than 3000 characters long.
    
<!-- END_a686c2d54be536fb3d5e4ad3a0bca081 -->


