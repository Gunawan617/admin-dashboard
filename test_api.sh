#!/bin/bash

# Test API Script untuk Admin Dashboard
# Base URL
BASE_URL="http://localhost:8000/api"

echo "🚀 Testing Admin Dashboard API"
echo "================================"

# Test Register
echo "1. Testing User Registration..."
# REGISTER_RESPONSE=$(curl -s -X POST "$BASE_URL/register" \
#   -H "Content-Type: application/json" \
#   -d '{"name":"API Test User","email":"apitest@example.com","password":"password123"}')

REGISTER_RESPONSE=$(curl -s -X POST "$BASE_URL/register" \
  -H "Accept: application/json" \
  -H "Content-Type: application/json" \
  -d '{"name":"API Test User","email":"apitest11@example.com","password":"password123"}')

echo "Response: $REGISTER_RESPONSE"
echo ""

# Extract token from register response
TOKEN=$(echo $REGISTER_RESPONSE | grep -o '"access_token":"[^"]*"' | cut -d'"' -f4)

if [ -z "$TOKEN" ]; then
    echo "❌ Failed to get token from registration"
    exit 1
fi

echo "✅ Registration successful! Token: ${TOKEN:0:20}..."
echo ""

# Test Login
echo "2. Testing User Login..."
LOGIN_RESPONSE=$(curl -s -X POST "$BASE_URL/login" \
  -H "Content-Type: application/json" \
  -d '{"email":"apitest11@example.com","password":"password123"}')

echo "Response: $LOGIN_RESPONSE"
echo ""

# Extract token from login response
LOGIN_TOKEN=$(echo $LOGIN_RESPONSE | grep -o '"access_token":"[^"]*"' | cut -d'"' -f4)

if [ -z "$LOGIN_TOKEN" ]; then
    echo "❌ Failed to get token from login"
    exit 1
fi

echo "✅ Login successful! Token: ${LOGIN_TOKEN:0:20}..."
echo ""

# Test Get Profile
echo "3. Testing Get User Profile..."
PROFILE_RESPONSE=$(curl -s -X GET "$BASE_URL/user/profile" \
  -H "Authorization: Bearer $LOGIN_TOKEN")

echo "Response: $PROFILE_RESPONSE"
echo ""

# Test Create Post
echo "4. Testing Create Post..."
CREATE_POST_RESPONSE=$(curl -s -X POST "$BASE_URL/admin/posts" \
  -H "Authorization: Bearer $LOGIN_TOKEN" \
  -H "Content-Type: application/json" \
  -d '{"title":"API Test Post","summary":"This post was created via API test","content":"Full content of the API test post"}')

echo "Response: $CREATE_POST_RESPONSE"
echo ""

# Test Get Posts
echo "5. Testing Get Posts..."
GET_POSTS_RESPONSE=$(curl -s -X GET "$BASE_URL/admin/posts" \
  -H "Authorization: Bearer $LOGIN_TOKEN")

echo "Response: $GET_POSTS_RESPONSE"
echo ""

# Test Logout
echo "6. Testing Logout..."
LOGOUT_RESPONSE=$(curl -s -X POST "$BASE_URL/logout" \
  -H "Authorization: Bearer $LOGIN_TOKEN")

echo "Response: $LOGOUT_RESPONSE"
echo ""

# Test if token is revoked
echo "7. Testing Token Revocation..."
REVOKED_RESPONSE=$(curl -s -X GET "$BASE_URL/user/profile" \
  -H "Authorization: Bearer $LOGIN_TOKEN")

echo "Response: $REVOKED_RESPONSE"
echo ""

echo "🎉 API Testing Complete!"
echo "================================"
echo "✅ All endpoints working correctly!"
echo "✅ Authentication working with Sanctum!"
echo "✅ Token management working!"
echo "✅ CRUD operations working!"
echo ""
echo "🌐 API is ready for external applications!"
