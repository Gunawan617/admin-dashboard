#!/bin/bash

echo "=== Testing Analytics API ==="
echo ""

echo "1. POST track visit (simulasi dari Next.js):"
curl -s -X POST http://localhost:8000/api/analytics/track \
  -H "Content-Type: application/json" \
  -d '{
    "url": "/homepage",
    "referrer": "https://google.com",
    "user_agent": "Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36"
  }'
echo ""
echo ""

echo "2. POST track visit lagi (halaman lain):"
curl -s -X POST http://localhost:8000/api/analytics/track \
  -H "Content-Type: application/json" \
  -d '{
    "url": "/about",
    "referrer": "/homepage",
    "user_agent": "Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36"
  }'
echo ""
echo ""

echo "3. POST track visit dari external site:"
curl -s -X POST http://localhost:8000/api/analytics/track \
  -H "Content-Type: application/json" \
  -d '{
    "url": "/products",
    "referrer": "https://facebook.com",
    "user_agent": "Mozilla/5.0 (iPhone; CPU iPhone OS 14_7_1 like Mac OS X) AppleWebKit/605.1.15"
  }'
echo ""
echo ""

echo "4. GET analytics stats:"
curl -s -X GET http://localhost:8000/api/analytics/stats
echo ""
echo ""

echo "5. GET all visits:"
curl -s -X GET http://localhost:8000/api/analytics/visits
echo ""
echo ""

echo "=== Analytics API Test Complete ==="
