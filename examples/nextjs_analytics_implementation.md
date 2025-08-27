# Implementasi Analytics API di Next.js

## 1. Buat Hook untuk Analytics

```typescript
// hooks/useAnalytics.ts
import { useEffect } from 'react';

interface VisitData {
  url: string;
  referrer?: string;
  user_agent?: string;
}

export const useAnalytics = (url: string) => {
  useEffect(() => {
    const trackVisit = async () => {
      try {
        const visitData: VisitData = {
          url: url,
          referrer: document.referrer || undefined,
          user_agent: navigator.userAgent,
        };

        await fetch('http://localhost:8000/api/analytics/track', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(visitData),
        });
      } catch (error) {
        console.error('Failed to track visit:', error);
      }
    };

    trackVisit();
  }, [url]);
};
```

## 2. Implementasi di Component/Page

```typescript
// pages/index.tsx atau components/HomePage.tsx
import { useAnalytics } from '../hooks/useAnalytics';

export default function HomePage() {
  useAnalytics('/homepage');

  return (
    <div>
      <h1>Welcome to Homepage</h1>
      {/* Your content */}
    </div>
  );
}
```

## 3. Implementasi di Layout/App

```typescript
// components/Layout.tsx atau _app.tsx
import { useRouter } from 'next/router';
import { useAnalytics } from '../hooks/useAnalytics';

export default function Layout({ children }: { children: React.ReactNode }) {
  const router = useRouter();
  
  // Track setiap perubahan route
  useAnalytics(router.asPath);

  return (
    <div>
      {children}
    </div>
  );
}
```

## 4. Custom Hook dengan Error Handling

```typescript
// hooks/useAnalytics.ts (versi lengkap)
import { useEffect, useRef } from 'react';

interface VisitData {
  url: string;
  referrer?: string;
  user_agent?: string;
}

interface AnalyticsResponse {
  success: boolean;
  message: string;
  visit?: any;
}

export const useAnalytics = (url: string) => {
  const hasTracked = useRef(false);

  useEffect(() => {
    if (hasTracked.current) return;
    
    const trackVisit = async () => {
      try {
        const visitData: VisitData = {
          url: url,
          referrer: document.referrer || undefined,
          user_agent: navigator.userAgent,
        };

        const response = await fetch('http://localhost:8000/api/analytics/track', {
          method: 'POST',
          headers: {
            'Content-Type': 'application/json',
          },
          body: JSON.stringify(visitData),
        });

        const data: AnalyticsResponse = await response.json();
        
        if (data.success) {
          console.log('Visit tracked successfully');
          hasTracked.current = true;
        } else {
          console.error('Failed to track visit:', data.message);
        }
      } catch (error) {
        console.error('Failed to track visit:', error);
      }
    };

    trackVisit();
  }, [url]);
};
```

## 5. Implementasi dengan React Context

```typescript
// contexts/AnalyticsContext.tsx
import React, { createContext, useContext, ReactNode } from 'react';

interface AnalyticsContextType {
  trackPageView: (url: string) => Promise<void>;
  trackEvent: (eventName: string, data?: any) => Promise<void>;
}

const AnalyticsContext = createContext<AnalyticsContextType | undefined>(undefined);

export const AnalyticsProvider: React.FC<{ children: ReactNode }> = ({ children }) => {
  const trackPageView = async (url: string) => {
    try {
      await fetch('http://localhost:8000/api/analytics/track', {
        method: 'POST',
        headers: {
          'Content-Type': 'application/json',
        },
        body: JSON.stringify({
          url,
          referrer: document.referrer || undefined,
          user_agent: navigator.userAgent,
        }),
      });
    } catch (error) {
      console.error('Failed to track page view:', error);
    }
  };

  const trackEvent = async (eventName: string, data?: any) => {
    // Implementasi untuk tracking event custom
    console.log('Event tracked:', eventName, data);
  };

  return (
    <AnalyticsContext.Provider value={{ trackPageView, trackEvent }}>
      {children}
    </AnalyticsContext.Provider>
  );
};

export const useAnalytics = () => {
  const context = useContext(AnalyticsContext);
  if (context === undefined) {
    throw new Error('useAnalytics must be used within an AnalyticsProvider');
  }
  return context;
};
```

## 6. Penggunaan dengan Context

```typescript
// _app.tsx
import { AnalyticsProvider } from '../contexts/AnalyticsContext';

function MyApp({ Component, pageProps }) {
  return (
    <AnalyticsProvider>
      <Component {...pageProps} />
    </AnalyticsProvider>
  );
}

export default MyApp;

// pages/about.tsx
import { useAnalytics } from '../contexts/AnalyticsContext';
import { useEffect } from 'react';

export default function AboutPage() {
  const { trackPageView } = useAnalytics();

  useEffect(() => {
    trackPageView('/about');
  }, [trackPageView]);

  return (
    <div>
      <h1>About Us</h1>
      {/* Your content */}
    </div>
  );
}
```

## 7. Environment Variables

```bash
# .env.local
NEXT_PUBLIC_ANALYTICS_API_URL=http://localhost:8000/api/analytics
```

```typescript
// hooks/useAnalytics.ts
const API_URL = process.env.NEXT_PUBLIC_ANALYTICS_API_URL || 'http://localhost:8000/api/analytics';

// Gunakan API_URL dalam fetch
await fetch(`${API_URL}/track`, {
  // ... rest of the code
});
```

## 8. Testing Analytics API

```bash
# Test tracking visit
curl -X POST http://localhost:8000/api/analytics/track \
  -H "Content-Type: application/json" \
  -d '{
    "url": "/test-page",
    "referrer": "https://google.com",
    "user_agent": "Mozilla/5.0 (Test Browser)"
  }'

# Test get stats
curl -X GET http://localhost:8000/api/analytics/stats

# Test get visits
curl -X GET http://localhost:8000/api/analytics/visits
```

## 9. Dashboard Analytics di Laravel

Setelah data terkumpul, Anda bisa melihat analytics di:
- `http://localhost:8000/api/analytics/stats` - Statistik lengkap
- `http://localhost:8000/api/analytics/visits` - Daftar semua visits
- `http://localhost:8000/api/analytics/dashboard` - Dashboard admin (jika ada view)
