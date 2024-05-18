# ToDo List API

This is a RESTful API for managing a todo list.

## Installation

1. Clone the repository:
   git clone https://github.com/anjuce/todo-list-api.git
2. Navigate to the project directory:
   cd todo-list-api
3. Run the project using Docker Compose:
   docker-compose up --build
4. Set up your environment variables by copying the `.env.example` file to `.env` and modifying it with your database credentials.

## Usage

### Authentication

To use the API, you need to authenticate. Send a POST request to `/login` with your email and password in the request body. You will receive a token which you can use to authenticate subsequent requests.

Example:

```json
{
    "email": "user@example.com",
    "password": "password123"
}
```

Endpoints
GET /tasks
Retrieve a list of tasks.

Parameters:

status: Filter by task status (optional)
priority: Filter by task priority (optional)
title: Search tasks by title (optional)
description: Search tasks by description (optional)
sort: Sort tasks by createdAt, completedAt, or priority (optional)


POST /tasks
Create a new task.

Example request body:
{
    "title": "Finish project",
    "description": "Complete the final report",
    "priority": 3
}

POST /tasks/{id}
Update an existing task.

Example request body:
{
    "title": "Finish project",
    "description": "Complete the final report",
    "priority": 5
}

DELETE /tasks/{id}
Delete a task.

POST /tasks/{id}/complete
Mark a task as completed.



Contributing
Contributions are welcome! Please fork the repository and create a pull request with your changes.

License
This project is licensed under the MIT License - see the LICENSE file for details.
