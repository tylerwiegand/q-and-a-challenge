# VH Takehome Q&A Test

The goal is to create a simple Q&A API using Symfony (4.\*) and NelmioApiDocBundle
The table structure is as follows:

- a questions table: id, question, rank (number)
- an answer table: id, answer_id, answer, tags (string)

The API needs to have a GET route where one can request the questions with pagination as well as ability to sort by rank
Another GET route for answers.
We need POST routes for creating a question and adding answers as well.
The answer needs to be sent with a docker image

We are looking for

- use of PHP 7.\* syntax
- consistency and clean code
- proper use of models, entities, repositories, controllers, etc.

For bonus points you can write tests.

# Included JSON Example

<details>
  <summary>JSON</summary>

```json
[
  {
    "id": 1,
    "question": "Question 1",
    "answers": [
      {
        "id": 1,
        "answer": "Answer 1",
        "rank": 3
      },
      {
        "id": 2,
        "answer": "Answer 2",
        "rank": 2
      }
    ],
    "tags": ["a", "b", "c"],
    "slug": "question_1"
  },
  {
    "id": 2,
    "question": "Question 2",
    "answers": [
      {
        "id": 1,
        "answer": "Answer 1",
        "rank": 3
      }
    ],
    "tags": ["a", "c"],
    "slug": "question_2"
  },
  {
    "id": 3,
    "question": "Question 3",
    "answers": [
      {
        "id": 1,
        "answer": "test",
        "rank": 3
      },
      {
        "id": 2,
        "answer": "test",
        "rank": 2
      }
    ],
    "tags": ["a"],
    "slug": "question_3"
  },
  {
    "id": 4,
    "question": "Question 4",
    "answers": [
      {
        "id": 1,
        "answer": "Answer 1",
        "rank": 3
      },
      {
        "id": 2,
        "answer": "Answer 2",
        "rank": 2
      },
      {
        "id": 3,
        "answer": "Answer 3",
        "rank": 2
      }
    ],
    "tags": ["c"],
    "slug": "question_4"
  },
  {
    "id": 5,
    "question": "Question 5",
    "answers": [
      {
        "id": 1,
        "answer": "Answer 1",
        "rank": 1
      },
      {
        "id": 2,
        "answer": "Answer 2",
        "rank": 4
      }
    ],
    "tags": ["d"],
    "slug": "question_5"
  },
  {
    "id": 6,
    "question": "Question 6",
    "answers": [
      {
        "id": 1,
        "answer": "Answer 1",
        "rank": 5
      }
    ],
    "tags": ["a", "b"],
    "slug": "question_6"
  }
]
```

</details>

# My notes

In my opinion there were some inconsistencies in instruction.

- The answer.tags database column is said to be a string, but returns as an array in the example JSON. The API Accepts a string as input, it is stored as a string, but it is casted as a comma-delimited array upon retrieval.

- There is no slug mentioned in the database design, but there is a slug returned for each question. Since I had already used a cast for another instance, I opted to use a package I VERY often pull in for slugs, spatie/laravel-sluggable for the Question model.

- The answer table shows an answer_id, but certainly what is intended here is a question_id to show which question an answer is attached to. This change is reflected in my migrations.

- The API description mentions a separate GET route for answers and questions, but in the example JSON they are both shown with each other. I have opted to show all answers with GET /questions, and show no questions with GET /answers.

# Config

I have limited experience with Docker. If this isn't what you were expecting...sorry!

Copy the .env contents to /src/.env

<details>
  <summary>.env</summary>

```env
APP_NAME="Vehicle History Q&A Challenge"
APP_ENV=local
APP_KEY=
APP_DEBUG=true
APP_URL=http://localhost:8080
APP_TIMEZONE=UTC

LOG_CHANNEL=stack
LOG_SLACK_WEBHOOK_URL=

DB_CONNECTION=mysql
DB_HOST=mysql
DB_PORT=3306
DB_DATABASE=homestead
DB_USERNAME=homestead
DB_PASSWORD=secret

CACHE_DRIVER=file
QUEUE_CONNECTION=sync
```

</details>

## Initialize Docker

```bash
docker-compose build
docker-composer up -d
```

Seed the database, if desired

```bash
docker-compose exec php php /var/www/html/artisan migrate:fresh --seed
```

Then you should be able to navigate to `localhost:8080/answers` and `localhost:8080/questions`.

## Tests

Navigate to the /src directory and run `vendor/bin/phpunit`
There should be 16 tests and 44 assertions.

# Why isn't this made in Symfony?!

When I spoke with Cristi (spelling?) he mentioned I could do the code challenge in Laravel. Lumen is a lightweight microframework based on Laravel, and since he also mentioned a lot of the work done was related to Microservices, it seemed like a better fit than the full Laravel framework.

I was also less familiar with Lumen, having only attempted to use it once years ago. It felt familiar enough, but different to the point that I was still learning something.

# Why aren't the Docs in NelmioApiDocBundle!?

Again, based on Cristi's approval of me using Laravel for the challenge, I did want to include SOME form of documentation. I tried several, but was only able to get [this](https://github.com/mpociot/laravel-apidoc-generator) to function with the newest version of [Lumen](https://lumen.laravel.com/) (7).

For the generated API docs, navigate to http://localhost:8080/docs/index.html
