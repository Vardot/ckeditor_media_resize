# Changelog

## 2.0.1
- Drupal 12 support: `drupal/core` and `core_version_requirement` are now `^11.2 || ^12`.
- Synced with upstream `drupal/ckeditor_media_resize` 1.1.x (tip = tag 1.1.1, commit `1ce2eed`). The fork already carried that code, so this adds the upstream history as a merge parent and no upstream code changes.
- No deprecated Drupal API use found (phpstan with phpstan-deprecation-rules, against Drupal 11.4 and 12.0.0-beta2).

## 2.0.0
- Initial Vardot fork release of `vardot/ckeditor_media_resize` on the `2.0.x` branch.
- Carries Drupal core 11.4 support from drupal.org issue #3607786 (commit `b5ccc4c2`).
- Package renamed to `vardot/ckeditor_media_resize`; `replace: drupal/ckeditor_media_resize`.
- Drupal core requirement `^11.2`.
- Release `.info.yml` includes drupal.org-style packaging metadata (`version` / `project` / `datestamp`).
