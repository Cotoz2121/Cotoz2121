# starter AI Theme - Advanced WordPress Theme

Advanced WordPress theme built with the latest web technologies, AI integration, full SEO optimization, and responsive design.

## Features

### Modern Technologies
- **PHP 8.2+** with typed properties, match expressions, named arguments, and strict types
- **CSS3** with custom properties, container queries, logical properties, and fluid typography
- **JavaScript ES2024+** with modules, private class fields, AbortController patterns, and modern APIs
- **HTML5** semantic markup with ARIA accessibility attributes

### AI & Google Smart Features
- **Schema.org JSON-LD** structured data (Article, WebPage, Organization, BreadcrumbList, FAQPage, SearchAction)
- **Google AI Overviews** compatible content structure with NLP-friendly markup
- **Speakable** specification for Google Assistant and voice search
- **Auto-detection** of FAQ content patterns for FAQPage schema generation
- **Google Discover** optimization with high-quality image metadata
- **SiteNavigationElement** schema for enhanced site links

### SEO
- Open Graph meta tags (Facebook, LinkedIn)
- Twitter Cards (summary_large_image)
- Canonical URLs with automatic detection
- Meta description generation
- Breadcrumb navigation with schema markup
- Google Analytics / Tag Manager integration
- Google Site Verification support
- Robots meta tag optimization
- max-image-preview:large for Google Discover

### Responsive Design
- Mobile-first CSS architecture
- Fluid typography with `clamp()`
- CSS Grid and Flexbox layouts
- Container queries for component-level responsiveness
- Touch device optimizations (44px min touch targets)
- Landscape orientation adjustments
- Print stylesheet
- High DPI / Retina display support

### Performance
- Core Web Vitals monitoring (LCP, FID/INP, CLS)
- Resource hints (preconnect, dns-prefetch, preload, prefetch)
- Link prefetching on hover
- Lazy loading with IntersectionObserver
- Deferred script loading
- Emoji removal for faster loading
- Critical resource preloading
- fetchpriority for LCP images

### Accessibility
- Skip to content link
- ARIA landmarks and labels
- Keyboard navigation for menus
- Focus trap in modals
- Focus-visible styles
- Screen reader only text
- Reduced motion support
- High contrast mode support

### Additional Features
- Dark mode with system preference detection and manual toggle
- RTL (Right-to-Left) language support
- Theme Customizer with live preview
- Custom widgets (Recent Posts with Thumbnails, Author Bio)
- Social sharing buttons (Twitter, Facebook, LinkedIn, WhatsApp, Telegram)
- Related posts section
- Reading time estimation
- Back to top button
- 4 footer widget areas
- 4 navigation menu locations

## Installation

1. Download or clone this repository
2. Copy to `wp-content/themes/starter-ai/`
3. Activate through WordPress Admin > Appearance > Themes
4. Configure via Appearance > Customize

## Requirements

- WordPress 6.4+
- PHP 8.2+

## Customizer Sections

- **Hero Section** - Title, subtitle, CTA buttons
- **Theme Colors** - Primary, secondary, accent colors
- **Social Media** - Links for all major platforms
- **SEO Settings** - Google Analytics ID, site verification
- **Newsletter** - Title, description, subscribe URL
- **Contact Information** - Email, phone, address

## File Structure

```
starter-ai/
├── style.css              # Theme metadata + base styles
├── functions.php          # Theme setup, enqueue, helpers
├── index.php              # Main template
├── header.php             # Header + navigation
├── footer.php             # Footer + back to top
├── sidebar.php            # Widget area
├── front-page.php         # Homepage template
├── single.php             # Single post
├── page.php               # Static page
├── archive.php            # Archive pages
├── search.php             # Search results
├── searchform.php         # Custom search form
├── 404.php                # Not found page
├── comments.php           # Comments template
├── inc/
│   ├── seo.php            # Meta tags, OG, Twitter Cards
│   ├── schema.php         # JSON-LD structured data
│   ├── ai-features.php    # AI/Google smart features
│   ├── customizer.php     # Theme customizer
│   ├── performance.php    # Performance optimization
│   └── widgets.php        # Custom widgets
├── assets/
│   ├── css/
│   │   ├── main.css       # Main layout styles
│   │   ├── responsive.css # Responsive breakpoints
│   │   ├── rtl.css        # RTL support
│   │   └── components/    # Component styles
│   └── js/
│       ├── app.js         # Main JS entry (ES module)
│       └── modules/       # JS modules
├── template-parts/        # Reusable template parts
└── languages/             # Translation files
```

## License

GNU General Public License v2 or later
