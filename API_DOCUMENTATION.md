# API Documentation - Admin Dashboard

## Base URL
```
http://your-domain.com/api
```

## Authentication
API menggunakan Laravel Sanctum untuk authentication. Semua request yang memerlukan authentication harus menyertakan header:
```
Authorization: Bearer {access_token}
```

## Endpoints

### 1. User Registration
**POST** `/api/register`

**Request Body:**
```json
{
    "name": "John Doe",
    "email": "john@example.com",
    "password": "password123"
}
```

**Response:**
```json
{
    "success": true,
    "message": "User registered successfully",
    "access_token": "1|abc123...",
    "token_type": "Bearer",
    "user": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com",
        "email_verified_at": null,
        "created_at": "2025-08-22T01:46:33.000000Z",
        "updated_at": "2025-08-22T01:46:33.000000Z"
    }
}
```

### 2. User Login
**POST** `/api/login`

**Request Body:**
```json
{
    "email": "john@example.com",
    "password": "password123"
}
```

**Response:**
```json
{
    "access_token": "1|abc123...",
    "token_type": "Bearer",
    "user": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com"
    }
}
```

### 3. Get User Profile
**GET** `/api/user/profile`

**Headers:**
```
Authorization: Bearer {access_token}
```

**Response:**
```json
{
    "success": true,
    "data": {
        "id": 1,
        "name": "John Doe",
        "email": "john@example.com"
    }
}
```

### 4. Logout
**POST** `/api/logout`

**Headers:**
```
Authorization: Bearer {access_token}
```

**Response:**
```json
{
    "success": true,
    "message": "Logged out successfully"
}
```

### 5. Posts Management

#### List All Posts
**GET** `/api/admin/posts`

**Headers:**
```
Authorization: Bearer {access_token}
```

**Response:**
```json
{
    "success": true,
    "data": {
        "current_page": 1,
        "data": [
            {
                "id": 1,
                "title": "Sample Post",
                "slug": "sample-post",
                "summary": "This is a sample post",
                "content": "Full content here...",
                "image": "posts/abc123.jpg",
                "created_at": "2025-08-22T01:46:33.000000Z",
                "updated_at": "2025-08-22T01:46:33.000000Z"
            }
        ],
        "per_page": 10,
        "total": 1
    }
}
```

#### Get Single Post
**GET** `/api/admin/posts/{id}`

**Headers:**
```
Authorization: Bearer {access_token}
```

**Response:**
```json
{
    "success": true,
    "data": {
        "id": 1,
        "title": "Sample Post",
        "slug": "sample-post",
        "summary": "This is a sample post",
        "content": "Full content here...",
        "image": "posts/abc123.jpg",
        "created_at": "2025-08-22T01:46:33.000000Z",
        "updated_at": "2025-08-22T01:46:33.000000Z"
    }
}
```

#### Create New Post
**POST** `/api/admin/posts`

**Headers:**
```
Authorization: Bearer {access_token}
Content-Type: multipart/form-data
```

**Request Body:**
```form-data
title: "New Post Title"
summary: "Post summary"
content: "Full post content"
image: [file] (optional)
```

**Response:**
```json
{
    "success": true,
    "message": "Post created successfully.",
    "data": {
        "id": 2,
        "title": "New Post Title",
        "slug": "new-post-title",
        "summary": "Post summary",
        "content": "Full post content",
        "image": "posts/def456.jpg",
        "created_at": "2025-08-22T01:46:33.000000Z",
        "updated_at": "2025-08-22T01:46:33.000000Z"
    }
}
```

#### Update Post
**PUT** `/api/admin/posts/{id}`

**Headers:**
```
Authorization: Bearer {access_token}
Content-Type: multipart/form-data
```

**Request Body:**
```form-data
title: "Updated Title"
summary: "Updated summary"
content: "Updated content"
image: [file] (optional)
```

**Response:**
```json
{
    "success": true,
    "message": "Post updated successfully.",
    "data": {
        "id": 1,
        "title": "Updated Title",
        "slug": "updated-title",
        "summary": "Updated summary",
        "content": "Updated content",
        "image": "posts/ghi789.jpg",
        "created_at": "2025-08-22T01:46:33.000000Z",
        "updated_at": "2025-08-22T01:46:33.000000Z"
    }
}
```

#### Delete Post
**DELETE** `/api/admin/posts/{id}`

**Headers:**
```
Authorization: Bearer {access_token}
```

**Response:**
```json
{
    "success": true,
    "message": "Post deleted successfully."
}
```

## Error Responses

### Validation Error (422)
```json
{
    "message": "The given data was invalid.",
    "errors": {
        "email": ["The email field is required."],
        "password": ["The password field is required."]
    }
}
```

### Unauthorized (401)
```json
{
    "message": "Unauthenticated."
}
```

### Not Found (404)
```json
{
    "success": false,
    "message": "Post not found."
}
```

## Testing API

### Using Postman/Insomnia
1. Set base URL: `http://your-domain.com/api`
2. For protected routes, add header: `Authorization: Bearer {token}`
3. Test endpoints in sequence: register → login → use token for other requests

### Using cURL
```bash
# Register
curl -X POST http://your-domain.com/api/register \
  -H "Content-Type: application/json" \
  -d '{"name":"Test User","email":"test@example.com","password":"password123"}'

# Login
curl -X POST http://your-domain.com/api/login \
  -H "Content-Type: application/json" \
  -d '{"email":"test@example.com","password":"password123"}'

# Use token for protected routes
curl -X GET http://your-domain.com/api/admin/posts \
  -H "Authorization: Bearer {your_token_here}"
```

## Notes
- Token expires based on Sanctum configuration
- Images are stored in `storage/app/public/posts/` directory
- All timestamps are in UTC timezone
- Pagination is set to 10 items per page for posts listing
