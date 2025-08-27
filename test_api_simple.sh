#!/bin/bash

echo "=== Testing API Books ==="
echo ""

echo "1. GET all books:"
curl -s -X GET http://localhost:8000/api/public/books
echo ""
echo ""

echo "2. POST new book:"
curl -s -X POST http://localhost:8000/api/public/books \
  -H "Content-Type: application/json" \
  -d '{
    "title": "Test Book via Script",
    "author": "Test Author via Script"
  }'
echo ""
echo ""

echo "3. GET all books again (to see new book):"
curl -s -X GET http://localhost:8000/api/public/books
echo ""
echo ""

echo "=== Testing API Posts dengan SEO Fields ==="
echo ""

echo "1. GET all posts:"
curl -s -X GET http://localhost:8000/api/public/posts
echo ""
echo ""

echo "2. POST new post dengan SEO fields:"
curl -s -X POST http://localhost:8000/api/public/posts \
  -H "Content-Type: application/json" \
  -d '{
    "title": "Test Post dengan SEO via Script",
    "summary": "Test Summary dengan SEO via Script",
    "content": "Test Content dengan SEO via Script",
    "meta_title": "Meta Title via Script",
    "meta_description": "Meta Description via Script",
    "meta_keywords": "script, test, seo",
    "canonical_url": "https://example.com/script-test",
    "status": "published",
    "author": "Script Author",
    "category": "Script Category"
  }'
echo ""
echo ""

echo "3. GET all posts again (to see new post dengan SEO):"
curl -s -X GET http://localhost:8000/api/public/posts
echo ""
echo ""

echo "=== API Test Complete ==="
