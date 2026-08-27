# Put your logo files here

This project references your logo at these EXACT paths — rename your files
to match (or update the paths in the two Blade files listed below):

| File you provide          | Goes here                                          | Used in |
|----------------------------|-----------------------------------------------------|---------|
| Main logo (SVG preferred)  | public/assets/images/logo/logo.svg                 | resources/views/partials/navbar.blade.php, resources/views/partials/footer.blade.php, resources/views/admin/layout.blade.php |
| Favicon (PNG, 32x32/64x64) | public/assets/images/logo/favicon.png              | resources/views/layouts/app.blade.php (<link rel="icon">) |

If your logo is a PNG/JPG instead of SVG, either:
1. Rename it to `logo.svg`'s sibling, e.g. `logo.png`, and change
   `asset('assets/images/logo/logo.svg')` to `asset('assets/images/logo/logo.png')`
   in the three Blade files above, OR
2. Just export/save it as `logo.svg` if you have a vector version.

A light-on-dark logo (white/ivory or gold) works best — the whole site
uses a near-black background (#14100D).
