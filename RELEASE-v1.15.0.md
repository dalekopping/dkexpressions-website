# DK Expressions Enterprise v1.15.0

## Scope

This release establishes the shared enterprise typography and readability system for the DK Expressions V4 approved child theme.

## Included

- Larger electric-blue kicker and eyebrow headings.
- High-contrast white supporting copy.
- Larger introductions and supporting paragraphs.
- Larger white service-card descriptions.
- Brighter, larger article, page and giveaway body copy.
- Larger white footer wording and links.
- Enlarged statistic values.
- Bold red numeric statistic values.
- White non-numeric statistic values when marked with `.dk-stat-text`, `.is-text`, or `data-stat-type="text"`.
- Larger, bold white statistic descriptions.
- Increased spacing between statistic values and descriptions.
- Larger client trust statements.
- Responsive statistic layouts for tablet and mobile.
- Existing semantic highlighting and neon-outline behaviour preserved.

## Implementation

The reusable standards live in:

`wp-content/themes/dk-expressions-v4-approved-fixes/assets/enterprise-v115.css`

The stylesheet is loaded after the parent and approved-fixes styles through the child theme's `functions.php`.

## Release status

Development branch: `feature/v1.15.0-enterprise-refinement`
