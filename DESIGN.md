# Google Stitch Design System Specification: NNAJI O.A & COMPANY
**Domain**: Corporate Real Estate, Asset Valuation & Estate Surveying  
**Brand Identity**: Institutional Prestige, Trust, 40+ Years of Authority, Precision, Nigerian & International Standards (NIESV, ESVRBON, CASLE).

---

## 1. Design Principles

1. **Institutional Dignity & Authority**:  
   Reflect over four decades of trusted valuation and estate management for corporate institutions, banks (AMCON, Keystone, Fidelity, NNPC), and government bodies.
2. **Precision & Transparency**:  
   Clean tabular data, crisp typography, distinct badges for verified credentials (FNIVS, RSV, ANIVS), and financial track record metrics.
3. **Harmonious Luxury & Warmth**:  
   Deep heritage green paired with imperial antique gold accents, offset against warm ivory/creams rather than harsh stark whites.
4. **Seamless Automation & Motion**:  
   Smooth interactive property filtering, micro-transitions on hover, real-time lifecycle status indicators (Available vs. Closed Deal Portfolio), and instant quote calculators.

---

## 2. Color Palette (Google Stitch Tokens)

```css
:root {
  /* Brand Primary: Heritage Green */
  --color-primary-950: #061b13;
  --color-primary-900: #0a2a1e;  /* Deep Forest Green (Dominant Header/Footer/Hero) */
  --color-primary-800: #0f3d2e;
  --color-primary-700: #14533e;
  --color-primary-600: #1c6e54;
  --color-primary-500: #248a6a;  /* Accent Green */
  
  /* Brand Accent: Imperial Antique Gold */
  --color-gold-900: #5c4308;
  --color-gold-700: #8c6812;
  --color-gold-500: #c5a059;     /* Core Gold Accent */
  --color-gold-400: #d4af37;     /* Bright Antique Gold */
  --color-gold-300: #e7cf84;
  --color-gold-100: #fbf6e8;     /* Gold Tint / Highlight Background */

  /* Neutral Backgrounds: Warm Ivory & Light Creams */
  --color-bg-base: #fdfbf7;      /* Warm Parchment / Body Background */
  --color-bg-surface: #ffffff;   /* Pure Card Surface */
  --color-bg-alt: #f4f0e6;       /* Alternate Section Cream */
  --color-bg-muted: #ece7da;     /* Subtle Borders & Dividers */

  /* Neutral Text: Deep Charcoal & Slates */
  --color-text-primary: #121816;   /* Near-black deep green-slate */
  --color-text-secondary: #4b5563; /* Slate grey for body paragraphs */
  --color-text-muted: #6b7280;     /* Muted labels & timestamps */
  --color-text-inverse: #fdfbf7;   /* Text on dark surfaces */

  /* State Tokens */
  --color-status-active-bg: #ecfdf5;
  --color-status-active-text: #047857;
  --color-status-sold-bg: #fef2f2;
  --color-status-sold-text: #b91c1c;
  --color-status-closed-bg: #fefce8;
  --color-status-closed-text: #a16207;
  --color-status-pending-bg: #eff6ff;
  --color-status-pending-text: #1d4ed8;

  /* Elevation Shadows */
  --shadow-sm: 0 1px 2px 0 rgba(10, 42, 30, 0.05);
  --shadow-md: 0 4px 12px -2px rgba(10, 42, 30, 0.08), 0 2px 4px -2px rgba(10, 42, 30, 0.04);
  --shadow-lg: 0 12px 24px -4px rgba(10, 42, 30, 0.12), 0 4px 8px -2px rgba(10, 42, 30, 0.06);
  --shadow-xl: 0 24px 48px -12px rgba(10, 42, 30, 0.18);
  --shadow-gold: 0 4px 20px -2px rgba(212, 175, 55, 0.25);

  /* Radii */
  --radius-sm: 4px;
  --radius-md: 8px;
  --radius-lg: 14px;
  --radius-xl: 20px;
  --radius-full: 9999px;
}
```

---

## 3. Typography Hierarchy

- **Serif Display Headings**: `Plus Jakarta Sans` and `Playfair Display` / `Cinzel` for formal authority, prestige, and institutional tone.
- **Sans-Serif Body**: `Plus Jakarta Sans`, `Inter`, system-ui for legible tabular data, metadata specs, and reading ease.

| Element | Font Family | Size | Weight | Line Height | Letter Spacing |
| :--- | :--- | :--- | :--- | :--- | :--- |
| **Hero H1** | Playfair Display | 3.5rem (56px) | 700 Bold | 1.15 | -0.02em |
| **Section H2** | Playfair Display | 2.5rem (40px) | 700 Bold | 1.25 | -0.01em |
| **Subheading H3** | Plus Jakarta Sans | 1.5rem (24px) | 600 SemiBold | 1.35 | 0 |
| **H4 / Card Title** | Plus Jakarta Sans | 1.2rem (19px) | 600 SemiBold | 1.4 | 0 |
| **Body Primary** | Plus Jakarta Sans | 1rem (16px) | 400 Regular | 1.65 | 0 |
| **Body Small / Meta** | Plus Jakarta Sans | 0.875rem (14px) | 500 Medium | 1.5 | 0.01em |
| **Overline / Badge** | Plus Jakarta Sans | 0.75rem (12px) | 700 Bold | 1.0 | 0.08em (Uppercase) |

---

## 4. Component Structure & Stitch Conventions

### 4.1 Header & Top Bar
- **Top Utility Strip**: Quick contact hotlines (`08035044633`, `08037002395`), corporate emails (`nnajioacompany@gmail.com`), and branch indicators (`Kaduna HQ`, `Abuja`, `Abia`, `USA Link`).
- **Main Navigation Bar**: Glassmorphic blur over deep dark green `#0a2a1e`, firm crest & typography, instant "Request Valuation" gold CTA button, mobile drawer menu.

### 4.2 Property Lifecycle Visual Indicators
- **Active Listing Card (`x-property-card`)**:
  - Live availability badge: `FOR SALE`, `FOR LEASE`, `JOINT VENTURE`.
  - High-res image slider with gradient overlay.
  - Key Specs Bar: Bed, Bath, Land Area, Location.
  - Price Tag in Naira (₦) with gold accent.
  - Quick action: "Inspect Property", "Schedule Valuation".
- **Closed Deal / Portfolio Card (`x-portfolio-card`)**:
  - Distinct `SOLD / TRANSACTED` ribbon in gold-bordered crimson or deep forest badge.
  - Transaction meta: "Completed Valuation / Acquisition", "Managed for [Client/AMCON/Private]".
  - Success metrics badge.

### 4.3 Corporate Authority & Metric Counters
- `₦50,000,000,000+` in Total Assets Valued.
- `40+ Years` Continuous Professional Practice (Est. 1981).
- `100+ Properties` Under Management Portfolio (₦3.3B+ value).
- `₦5,000,000,000+` Cumulative Investment Feasibility Capital.
- `4 Operational Offices` (Kaduna HQ, Abuja, Abia, USA Link).

### 4.4 Leadership & Key Team Showcase
- Grid of senior partners with official cadastral registration badges (`FNIVS`, `RSV`, `ANIVS`).
- Expandable biographical CV drawers showcasing track record across national projects (NDPHC, NNPC, AMCON, Knight Frank & Rutley legacy).

### 4.5 Admin CMS Interface
- Clean, high-density estate management dashboard.
- 1-click status switch: Instant AJAX lifecycle transition from `Active Listing` $\rightarrow$ `Sold (Closed Deals Portfolio)` with real-time feedback.
- Lead intake queue for valuation and inspection requests with status tags (`New`, `Contacted`, `Completed`).

---

## 5. Layout Grid & Responsiveness

- **Container Max Width**: `1280px` with `24px` gutter on desktop, `16px` on mobile.
- **Grid Layouts**:
  - Property listings: 3 columns (`lg:grid-cols-3 md:grid-cols-2 grid-cols-1`).
  - Services: 3-4 columns with feature icons.
  - Branch locator: 4 equal luxury cards.
- **Accessibility**: AAA contrast on text-on-cream and gold-on-green elements.
