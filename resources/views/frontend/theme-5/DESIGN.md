---
name: Logistics Modernist
colors:
  surface: '#f9f9ff'
  surface-dim: '#d0daf2'
  surface-bright: '#f9f9ff'
  surface-container-lowest: '#ffffff'
  surface-container-low: '#f0f3ff'
  surface-container: '#e8eeff'
  surface-container-high: '#dfe8ff'
  surface-container-highest: '#d9e3fb'
  on-surface: '#111c2d'
  on-surface-variant: '#3c4a42'
  inverse-surface: '#273143'
  inverse-on-surface: '#ecf0ff'
  outline: '#6c7b71'
  outline-variant: '#bbcabf'
  surface-tint: '#006c49'
  primary: '#006c49'
  on-primary: '#ffffff'
  primary-container: '#00c98c'
  on-primary-container: '#004e34'
  inverse-primary: '#3ae0a1'
  secondary: '#55615a'
  on-secondary: '#ffffff'
  secondary-container: '#d9e6dd'
  on-secondary-container: '#5b6760'
  tertiary: '#535f71'
  on-tertiary: '#ffffff'
  tertiary-container: '#a5b1c6'
  on-tertiary-container: '#384455'
  error: '#ba1a1a'
  on-error: '#ffffff'
  error-container: '#ffdad6'
  on-error-container: '#93000a'
  primary-fixed: '#5ffdbb'
  primary-fixed-dim: '#3ae0a1'
  on-primary-fixed: '#002114'
  on-primary-fixed-variant: '#005236'
  secondary-fixed: '#d9e6dd'
  secondary-fixed-dim: '#bdcac1'
  on-secondary-fixed: '#131e19'
  on-secondary-fixed-variant: '#3e4943'
  tertiary-fixed: '#d7e3f9'
  tertiary-fixed-dim: '#bbc7dc'
  on-tertiary-fixed: '#101c2c'
  on-tertiary-fixed-variant: '#3c4859'
  background: '#f9f9ff'
  on-background: '#111c2d'
  surface-variant: '#d9e3fb'
typography:
  display-lg:
    fontFamily: Plus Jakarta Sans
    fontSize: 60px
    fontWeight: '800'
    lineHeight: 72px
    letterSpacing: -0.02em
  display-lg-mobile:
    fontFamily: Plus Jakarta Sans
    fontSize: 40px
    fontWeight: '800'
    lineHeight: 48px
    letterSpacing: -0.02em
  headline-lg:
    fontFamily: Plus Jakarta Sans
    fontSize: 36px
    fontWeight: '700'
    lineHeight: 44px
    letterSpacing: -0.01em
  headline-md:
    fontFamily: Plus Jakarta Sans
    fontSize: 28px
    fontWeight: '700'
    lineHeight: 36px
  body-lg:
    fontFamily: Plus Jakarta Sans
    fontSize: 18px
    fontWeight: '400'
    lineHeight: 28px
  body-md:
    fontFamily: Plus Jakarta Sans
    fontSize: 16px
    fontWeight: '400'
    lineHeight: 24px
  label-md:
    fontFamily: Plus Jakarta Sans
    fontSize: 14px
    fontWeight: '600'
    lineHeight: 20px
    letterSpacing: 0.02em
  label-sm:
    fontFamily: Plus Jakarta Sans
    fontSize: 12px
    fontWeight: '700'
    lineHeight: 16px
rounded:
  sm: 0.25rem
  DEFAULT: 0.5rem
  md: 0.75rem
  lg: 1rem
  xl: 1.5rem
  full: 9999px
spacing:
  container-max: 1280px
  gutter: 24px
  margin-desktop: 80px
  margin-mobile: 20px
  stack-sm: 8px
  stack-md: 16px
  stack-lg: 32px
  section-padding: 100px
---

## Brand & Style

The design system is built for a modern, reliable, and high-velocity logistics service. The brand personality is efficient yet approachable, combining the precision of a technology platform with the friendliness of a local courier. 

The visual style leans into **Corporate Modernism** with a **Soft-Minimalist** touch. It prioritizes clarity through ample whitespace, a vibrant primary accent that signals action and growth, and a soft depth model that makes the interface feel tangible and trustworthy. The goal is to evoke a sense of "worry-free delivery" through clean lines and an airy, organized layout.

## Colors

The palette is anchored by a high-energy "Action Green" that symbolizes movement and "go" status. This is balanced by deep slate neutrals for high-contrast typography and soft mint washes for background containment.

- **Primary (#00C98C):** Used for primary actions, success states, and brand highlights.
- **Secondary (#F0FDF4):** A soft tint used for section backgrounds, hover states, and subtle grouping.
- **Tertiary (#1D2939):** A deep charcoal used for primary headings to ensure maximum legibility and professional authority.
- **Neutral (#667085):** A cool-toned grey used for secondary body text and icons.
- **Surface:** Pure white (#FFFFFF) is used for cards and interactive inputs to create a distinct layer above the secondary background tint.

## Typography

This design system utilizes **Plus Jakarta Sans** across all levels to maintain a cohesive, geometric, and modern aesthetic. The typeface's open counters and clean apertures ensure high legibility in data-heavy tracking tables and mobile interfaces.

Hierarchy is established through significant weight shifts (ExtraBold for displays vs. Regular for body) and the use of tight negative letter-spacing on large headings to create a compact, "editorial" look. Label styles should be used for metadata, buttons, and overlines, often employing a slightly heavier weight to maintain prominence at smaller sizes.

## Layout & Spacing

The layout follows a **Fluid-Fixed Hybrid** model. Content is contained within a 1280px central track on desktop, while background colors and decorative elements bleed to the edge of the viewport.

A 12-column grid is used for desktop layouts, transitioning to a 4-column grid for mobile devices. Spacing follows a strict 8px base unit. 
- **Vertical Rhythm:** Large sections are separated by 100px of padding to provide visual "breathing room."
- **Internal Spacing:** Components use a tiered stack system (8px, 16px, 32px) to define relationships between elements.
- **Mobile Reflow:** On mobile, side-by-side card layouts should stack vertically, and horizontal margins should reduce to 20px to maximize content area.

## Elevation & Depth

Hierarchy is conveyed through **Tonal Layering** and **Ambient Shadows**. This design system avoids harsh borders in favor of soft shadows that suggest physical lift.

1.  **Level 0 (Floor):** Used for the main page background, typically #FFFFFF or the secondary mint tint.
2.  **Level 1 (Card):** White surfaces with a very soft, diffused shadow (0px 4px 20px rgba(0, 0, 0, 0.05)). This is the primary container for content modules.
3.  **Level 2 (Interactive):** Elements like "Calculate" widgets or active inputs use a slightly more pronounced shadow or a subtle primary-colored glow to indicate focus.
4.  **Floating (Modals/Nav):** High elevation with a larger blur radius (0px 10px 30px rgba(0, 0, 0, 0.08)) to separate from the background content.

## Shapes

The shape language is consistently **Rounded**. This softens the corporate nature of logistics and makes the UI feel more accessible.

- **Buttons & Inputs:** Use the standard 0.5rem (8px) radius.
- **Content Cards:** Use the `rounded-lg` (16px) radius for a friendlier, containerized look.
- **Badges & Overlines:** Use pill-shaped (100px) rounding to distinguish them from interactive buttons.
- **Media/Imagery:** Feature images and maps should mirror the card radius (16px) to maintain a cohesive visual rhythm.

## Components

### Buttons
Primary buttons utilize the Primary Green (#00C98C) with white text. They should have a minimum height of 48px for touch accessibility. Hover states should darken the background by 10%. Secondary buttons use a transparent background with a Primary Green border or text.

### Input Fields
Inputs are defined by a light grey border (#E4E7EC) and a height of 52px. On focus, the border transitions to Primary Green with a soft 2px outer glow. Labels sit above the input in the `label-md` style.

### Cards
Cards are the primary structural unit. They feature a white background, 16px corner radius, and 32px of internal padding. For "Specialities" or "Pricing," cards should include a subtle transition on hover (lifting 4px) to indicate interactivity.

### Chips & Badges
Small status indicators (e.g., "Within City" or "Discount") use the pill-shaped geometry. They typically feature a light version of the Primary color (Secondary #F0FDF4) with dark green text for high readability.

### Progress & Tracking
Tracking numbers and status bars should use a high-contrast treatment. The tracking input should be prominent, often paired with a high-contrast Primary button to drive the main user objective.