renewal2026 テーマ ディレクトリリスト
====================================

■ ルート直下のPHP
  archive-case.php
  archive-doctor.php
  archive-faq.php
  archive-menu.php
  archive-news.php
  archive-price.php
  category.php
  date.php
  footer.php
  front-page.php（トップページ）
  functions.php
  header-meta.php
  header.php
  home.php（投稿一覧）
  page-about.php
  page-access.php
  page-blog.php
  search.php
  single-case.php
  single-menu.php
  single-news.php
  single-price.php
  single.php（投稿単体）
  style.css
  .gitignore
  README.md

■ assets/css
  common.css

■ assets/img
  about/ … featuer-card.svg, flow-01〜04.jpg
  common/ … arrow.svg, logo.svg, pagination-next.svg, noimage-doc.jpg など（共通アイコン・画像）

■ assets/js
  access.js
  common.js
  info.js
  service.js
  top.js

■ assets/scss
  common.scss
  foundation/base/ … _base.scss, _index.scss, _reset.scss
  foundation/function/ … _index.scss, _mixin.scss, _mq.scss, _size.scss, _var.scss
  layout/ … _footer.scss, _header.scss, _index.scss, _pageTransition.scss
  object/component/ … _index.scss, _parts.scss
  object/page/ … _about.scss, _access.scss, _blog.scss, _doctor.scss, _faq.scss, _index.scss, _menu.scss, _news.scss, _price.scss, _search.scss, _top.scss

■ blocks
  blog-block/ … block.json, blog-block.php
  case-block/ … block.json, case-block.php
  faq-block/ … block.json, faq-block.php
  price-block/ … block.json, price-block.php

■ inc
  breadcrumbs.php
  search/ … search-post.php, search-site.php（検索結果パーツ）

====================================
主要な役割
  front-page.php … トップページ
  home.php … 投稿一覧（/blog/ 等）
  single.php … 投稿単体
  page-*.php … 固定ページ用テンプレート（About, Access, Blog）
  archive-*.php … 各投稿タイプのアーカイブ
  search.php … 検索結果。inc/search/ で post / site / news を出し分け
  blocks/ … ブロック（blog, case, faq, price）
