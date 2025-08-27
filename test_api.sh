#!/bin/bash

echo "=== Testing API Books ==="
echo ""

echo "1. GET all books:"
curl -s -X GET http://localhost:8000/api/public/books | jq '.'
echo ""

echo "2. POST new book:"
curl -s -X POST http://localhost:8000/api/public/books \
  -H "Content-Type: application/json" \
  -d '{
    "title": "Test Book via Script",
    "author": "Test Author via Script"
  }' | jq '.'
echo ""

echo "3. GET all books again (to see new book):"
curl -s -X GET http://localhost:8000/api/public/books | jq '.'
echo ""

echo "=== Testing API Posts ==="
echo ""

echo "1. GET all posts:"
curl -s -X GET http://localhost:8000/api/public/posts | jq '.'
echo ""

echo "2. POST new post:"
curl -s -X POST http://localhost:8000/api/public/posts \
  -H "Content-Type: application/json" \
  -d '{
    "title": "Test Post via Script",
    "summary": "Test Summary via Script",
    "content": "Test Content via Script"
  }' | jq '.'
echo ""

echo "3. GET all posts again (to see new post):"
curl -s -X GET http://localhost:8000/api/public/posts | jq '.'
echo ""

echo "=== API Test Complete ==="
