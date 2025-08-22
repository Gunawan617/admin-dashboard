# Contoh Implementasi API Client

## 1. JavaScript/Node.js

### Axios Client
```javascript
// apiClient.js
import axios from 'axios';

class ApiClient {
  constructor(baseURL) {
    this.client = axios.create({
      baseURL: baseURL,
      timeout: 10000,
      headers: {
        'Content-Type': 'application/json'
      }
    });

    // Auto-attach token
    this.client.interceptors.request.use((config) => {
      const token = localStorage.getItem('access_token');
      if (token) {
        config.headers.Authorization = `Bearer ${token}`;
      }
      return config;
    });

    // Handle 401 responses
    this.client.interceptors.response.use(
      (response) => response,
      (error) => {
        if (error.response?.status === 401) {
          localStorage.removeItem('access_token');
          window.location.href = '/login';
        }
        return Promise.reject(error);
      }
    );
  }

  // Auth methods
  async register(userData) {
    const response = await this.client.post('/register', userData);
    if (response.data.access_token) {
      localStorage.setItem('access_token', response.data.access_token);
    }
    return response.data;
  }

  async login(credentials) {
    const response = await this.client.post('/login', credentials);
    if (response.data.access_token) {
      localStorage.setItem('access_token', response.data.access_token);
    }
    return response.data;
  }

  async logout() {
    const response = await this.client.post('/logout');
    localStorage.removeItem('access_token');
    return response.data;
  }

  async getProfile() {
    const response = await this.client.get('/user/profile');
    return response.data;
  }

  // Posts methods
  async getPosts(page = 1) {
    const response = await this.client.get(`/admin/posts?page=${page}`);
    return response.data;
  }

  async getPost(id) {
    const response = await this.client.get(`/admin/posts/${id}`);
    return response.data;
  }

  async createPost(postData) {
    const response = await this.client.post('/admin/posts', postData);
    return response.data;
  }

  async updatePost(id, postData) {
    const response = await this.client.put(`/admin/posts/${id}`, postData);
    return response.data;
  }

  async deletePost(id) {
    const response = await this.client.delete(`/admin/posts/${id}`);
    return response.data;
  }
}

// Usage
const api = new ApiClient('http://localhost:8000/api');

// Example usage
async function example() {
  try {
    // Login
    const loginResult = await api.login({
      email: 'user@example.com',
      password: 'password123'
    });
    console.log('Logged in:', loginResult.user.name);

    // Get posts
    const posts = await api.getPosts();
    console.log('Posts:', posts.data);

    // Create post
    const newPost = await api.createPost({
      title: 'New Post',
      summary: 'Summary',
      content: 'Content'
    });
    console.log('Created post:', newPost.data);

  } catch (error) {
    console.error('API Error:', error.response?.data || error.message);
  }
}
```

## 2. React/Next.js Hook

```javascript
// useApi.js
import { useState, useCallback } from 'react';
import { api } from './apiClient';

export function useApi() {
  const [loading, setLoading] = useState(false);
  const [error, setError] = useState(null);

  const execute = useCallback(async (apiCall) => {
    setLoading(true);
    setError(null);
    
    try {
      const result = await apiCall();
      return result;
    } catch (err) {
      setError(err.response?.data?.message || err.message);
      throw err;
    } finally {
      setLoading(false);
    }
  }, []);

  return {
    loading,
    error,
    execute
  };
}

// Usage in component
function PostsComponent() {
  const { loading, error, execute } = useApi();
  const [posts, setPosts] = useState([]);

  const fetchPosts = useCallback(async () => {
    try {
      const result = await execute(() => api.getPosts());
      setPosts(result.data.data);
    } catch (err) {
      // Error already set by hook
    }
  }, [execute]);

  const createPost = useCallback(async (postData) => {
    try {
      await execute(() => api.createPost(postData));
      fetchPosts(); // Refresh list
    } catch (err) {
      // Error already set by hook
    }
  }, [execute, fetchPosts]);

  return (
    <div>
      {loading && <div>Loading...</div>}
      {error && <div>Error: {error}</div>}
      
      <button onClick={fetchPosts}>Load Posts</button>
      
      {posts.map(post => (
        <div key={post.id}>
          <h3>{post.title}</h3>
          <p>{post.summary}</p>
        </div>
      ))}
    </div>
  );
}
```

## 3. Python (Requests)

```python
# api_client.py
import requests
import json

class ApiClient:
    def __init__(self, base_url):
        self.base_url = base_url
        self.token = None
        self.session = requests.Session()
    
    def _get_headers(self):
        headers = {'Content-Type': 'application/json'}
        if self.token:
            headers['Authorization'] = f'Bearer {self.token}'
        return headers
    
    def register(self, name, email, password):
        data = {'name': name, 'email': email, 'password': password}
        response = self.session.post(
            f'{self.base_url}/register',
            json=data,
            headers=self._get_headers()
        )
        result = response.json()
        if 'access_token' in result:
            self.token = result['access_token']
        return result
    
    def login(self, email, password):
        data = {'email': email, 'password': password}
        response = self.session.post(
            f'{self.base_url}/login',
            json=data,
            headers=self._get_headers()
        )
        result = response.json()
        if 'access_token' in result:
            self.token = result['access_token']
        return result
    
    def logout(self):
        response = self.session.post(
            f'{self.base_url}/logout',
            headers=self._get_headers()
        )
        self.token = None
        return response.json()
    
    def get_profile(self):
        response = self.session.get(
            f'{self.base_url}/user/profile',
            headers=self._get_headers()
        )
        return response.json()
    
    def get_posts(self, page=1):
        response = self.session.get(
            f'{self.base_url}/admin/posts?page={page}',
            headers=self._get_headers()
        )
        return response.json()
    
    def create_post(self, title, summary, content):
        data = {'title': title, 'summary': summary, 'content': content}
        response = self.session.post(
            f'{self.base_url}/admin/posts',
            json=data,
            headers=self._get_headers()
        )
        return response.json()

# Usage
if __name__ == '__main__':
    api = ApiClient('http://localhost:8000/api')
    
    try:
        # Login
        result = api.login('user@example.com', 'password123')
        print(f"Logged in as: {result['user']['name']}")
        
        # Get posts
        posts = api.get_posts()
        print(f"Found {len(posts['data']['data'])} posts")
        
        # Create post
        new_post = api.create_post(
            'Python Test Post',
            'Created via Python client',
            'This post was created using Python requests'
        )
        print(f"Created post: {new_post['data']['title']}")
        
    except Exception as e:
        print(f"Error: {e}")
```

## 4. PHP (cURL)

```php
<?php
// api_client.php

class ApiClient {
    private $baseUrl;
    private $token;
    
    public function __construct($baseUrl) {
        $this->baseUrl = $baseUrl;
    }
    
    private function makeRequest($method, $endpoint, $data = null) {
        $url = $this->baseUrl . $endpoint;
        
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->token
        ]);
        
        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_POST, true);
            if ($data) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            }
        } elseif ($method === 'PUT') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'PUT');
            if ($data) {
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
            }
        } elseif ($method === 'DELETE') {
            curl_setopt($ch, CURLOPT_CUSTOMREQUEST, 'DELETE');
        }
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);
        
        if ($httpCode >= 400) {
            throw new Exception("HTTP Error: $httpCode - $response");
        }
        
        return json_decode($response, true);
    }
    
    public function register($name, $email, $password) {
        $data = ['name' => $name, 'email' => $email, 'password' => $password];
        $result = $this->makeRequest('POST', '/register', $data);
        
        if (isset($result['access_token'])) {
            $this->token = $result['access_token'];
        }
        
        return $result;
    }
    
    public function login($email, $password) {
        $data = ['email' => $email, 'password' => $password];
        $result = $this->makeRequest('POST', '/login', $data);
        
        if (isset($result['access_token'])) {
            $this->token = $result['access_token'];
        }
        
        return $result;
    }
    
    public function logout() {
        $result = $this->makeRequest('POST', '/logout');
        $this->token = null;
        return $result;
    }
    
    public function getProfile() {
        return $this->makeRequest('GET', '/user/profile');
    }
    
    public function getPosts($page = 1) {
        return $this->makeRequest('GET', "/admin/posts?page=$page");
    }
    
    public function createPost($title, $summary, $content) {
        $data = ['title' => $title, 'summary' => $summary, 'content' => $content];
        return $this->makeRequest('POST', '/admin/posts', $data);
    }
    
    public function updatePost($id, $title, $summary, $content) {
        $data = ['title' => $title, 'summary' => $summary, 'content' => $content];
        return $this->makeRequest('PUT', "/admin/posts/$id", $data);
    }
    
    public function deletePost($id) {
        return $this->makeRequest('DELETE', "/admin/posts/$id");
    }
}

// Usage
try {
    $api = new ApiClient('http://localhost:8000/api');
    
    // Login
    $result = $api->login('user@example.com', 'password123');
    echo "Logged in as: " . $result['user']['name'] . "\n";
    
    // Get posts
    $posts = $api->getPosts();
    echo "Found " . count($posts['data']['data']) . " posts\n";
    
    // Create post
    $newPost = $api->createPost(
        'PHP Test Post',
        'Created via PHP client',
        'This post was created using PHP cURL'
    );
    echo "Created post: " . $newPost['data']['title'] . "\n";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage() . "\n";
}
?>
```

## 5. Mobile App (React Native)

```javascript
// apiService.js
import AsyncStorage from '@react-native-async-storage/async-storage';
import { Alert } from 'react-native';

const BASE_URL = 'http://localhost:8000/api';

class ApiService {
  constructor() {
    this.baseURL = BASE_URL;
  }

  async getHeaders() {
    const token = await AsyncStorage.getItem('access_token');
    return {
      'Content-Type': 'application/json',
      ...(token && { Authorization: `Bearer ${token}` }),
    };
  }

  async handleResponse(response) {
    if (response.status === 401) {
      await AsyncStorage.removeItem('access_token');
      // Navigate to login screen
      return null;
    }
    
    if (!response.ok) {
      throw new Error(`HTTP ${response.status}: ${response.statusText}`);
    }
    
    return response.json();
  }

  async request(endpoint, options = {}) {
    const headers = await this.getHeaders();
    
    const config = {
      headers,
      ...options,
    };

    try {
      const response = await fetch(`${this.baseURL}${endpoint}`, config);
      return await this.handleResponse(response);
    } catch (error) {
      Alert.alert('API Error', error.message);
      throw error;
    }
  }

  // Auth methods
  async register(userData) {
    const result = await this.request('/register', {
      method: 'POST',
      body: JSON.stringify(userData),
    });
    
    if (result?.access_token) {
      await AsyncStorage.setItem('access_token', result.access_token);
    }
    
    return result;
  }

  async login(credentials) {
    const result = await this.request('/login', {
      method: 'POST',
      body: JSON.stringify(credentials),
    });
    
    if (result?.access_token) {
      await AsyncStorage.setItem('access_token', result.access_token);
    }
    
    return result;
  }

  async logout() {
    const result = await this.request('/logout', { method: 'POST' });
    await AsyncStorage.removeItem('access_token');
    return result;
  }

  // Posts methods
  async getPosts(page = 1) {
    return this.request(`/admin/posts?page=${page}`);
  }

  async createPost(postData) {
    return this.request('/admin/posts', {
      method: 'POST',
      body: JSON.stringify(postData),
    });
  }
}

export default new ApiService();
```

## 6. Environment Configuration

```bash
# .env
API_BASE_URL=http://localhost:8000/api
API_TIMEOUT=10000
API_RETRY_ATTEMPTS=3

# Production
# API_BASE_URL=https://your-domain.com/api
# API_TIMEOUT=30000
# API_RETRY_ATTEMPTS=5
```

## 7. Error Handling & Retry Logic

```javascript
// retryWrapper.js
export async function withRetry(fn, maxRetries = 3, delay = 1000) {
  for (let i = 0; i < maxRetries; i++) {
    try {
      return await fn();
    } catch (error) {
      if (i === maxRetries - 1) throw error;
      
      // Wait before retry
      await new Promise(resolve => setTimeout(resolve, delay * (i + 1)));
    }
  }
}

// Usage
const posts = await withRetry(() => api.getPosts());
```

## 8. Testing dengan Postman

1. **Collection Setup:**
   - Base URL: `http://localhost:8000/api`
   - Environment variables: `base_url`, `access_token`

2. **Pre-request Script untuk Auto-token:**
```javascript
if (pm.environment.get("access_token")) {
    pm.request.headers.add({
        key: "Authorization",
        value: "Bearer " + pm.environment.get("access_token")
    });
}
```

3. **Test Script untuk Auto-save token:**
```javascript
if (pm.response.code === 200 || pm.response.code === 201) {
    const response = pm.response.json();
    if (response.access_token) {
        pm.environment.set("access_token", response.access_token);
    }
}
```

## 9. Security Best Practices

1. **Token Storage:**
   - Web: `localStorage` (for development), `httpOnly` cookies (production)
   - Mobile: `Keychain` (iOS), `Keystore` (Android)
   - Desktop: Secure storage APIs

2. **Token Refresh:**
   - Implement refresh token mechanism
   - Auto-refresh before expiration
   - Handle concurrent requests

3. **Rate Limiting:**
   - Implement exponential backoff
   - Respect API rate limits
   - Queue requests if needed

4. **Error Handling:**
   - Network errors
   - Authentication errors
   - Validation errors
   - Server errors

## 10. Monitoring & Logging

```javascript
// apiLogger.js
class ApiLogger {
  logRequest(method, endpoint, data) {
    console.log(`[API] ${method} ${endpoint}`, data);
  }
  
  logResponse(endpoint, response, duration) {
    console.log(`[API] ${endpoint} completed in ${duration}ms`, response);
  }
  
  logError(endpoint, error) {
    console.error(`[API] ${endpoint} failed:`, error);
  }
}

export default new ApiLogger();
```

Dengan contoh-contoh ini, aplikasi lain bisa dengan mudah mengintegrasikan dengan API Admin Dashboard yang sudah dibuat! 🚀
