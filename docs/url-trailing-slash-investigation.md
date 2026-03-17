# URL末尾スラッシュ（/）統一 調査結果

## 概要
URL末尾に `/` を統一するため、テーマ内の全ファイルを対象に「末尾スラッシュが付かない可能性がある箇所」を調査しました。

---

## 1. すでに末尾スラッシュ付きで記述されている箇所（問題なし）

以下のように `home_url()` に `'/path/'` を付けており、末尾は `/` で統一されています。

| ファイル | 内容 |
|----------|------|
| **header.php** | `home_url() . '/'`, `home_url() . '/contact/'`, `home_url() . '/information/'`, `home_url() . '/doctor/'`, `home_url() . '/case/'`, `home_url() . '/payment/'`, `home_url() . '/blog/'`, `home_url() . '/faq/'`, `home_url() . '/news/'`, `home_url() . '/monitor/'`, `home_url() . '/access/'`, `home_url() . '/recruit/'` |
| **footer.php** | 上記と同様のナビ・リンク（すべて `home_url() . '/xxx/'`） |
| **inc/breadcrumbs.php** | トップ・料金表・施術メニュー・お知らせ・よくある質問・症例・院長ブログなど（`home_url() . '/payment/'` 等） |
| **page-contact.php** | `home_url() . '/privacy-policy/'`, `home_url( '/thanks/' )` |
| **page-thanks.php** | `home_url('/')` |
| **single.php** | `home_url('/blog/')` |
| **blocks/case-block/case-block.php** | `home_url('/case/')` |
| **functions.php** | `get_blog_pagenum_link()` 内の `home_url('/blog/')`, `home_url('/blog/page/'.$page.'/')`、投稿スラッグ説明の `home_url('/blog/'.$slug.'/')`、`post_link` フィルターで `home_url('/blog/'.$post->post_name.'/')` |
| **archive-case.php** | `home_url('/search-case/?menu=' ...)`（パス部分は `/search-case/` で末尾スラッシュあり） |

---

## 2. 末尾スラッシュが付かない可能性がある箇所

WordPress のパーマリンク設定や投稿タイプの登録内容によって、**末尾に `/` が付かない場合があります**。以下はそのような「出力元」ごとの一覧です。

### 2.1 投稿タイプアーカイブURL `get_post_type_archive_link()`

| ファイル | 行 | コード | 説明 |
|----------|-----|--------|------|
| **inc/breadcrumbs.php** | 104 | `get_post_type_archive_link('case')` | 症例アーカイブへのリンク。WPの設定次第で末尾が `/` にならない場合あり。 |
| **functions.php** | 332 | `wp_safe_redirect(get_post_type_archive_link('case'), 302)` | 無効な search-case 時のリダイレクト先。同上。 |

### 2.2 個別投稿・固定ページ・CPTのURL `get_permalink()` / `get_the_permalink()` / `the_permalink()`

※ 投稿（post）は `functions.php` の `post_link` フィルターで `/blog/スラッグ/` に統一済み。  
※ 固定ページは多くの環境で元から末尾 `/` が付きます。  
※ **カスタム投稿タイプ（menu, case, doctor, news, price）の単体URLは、多くの環境で末尾に `/` が付きません。**

| ファイル | 行付近 | 用途 |
|----------|--------|------|
| **index.php** | 19, 69, 175, 199, 253, 464, 559, 577, 584 | FVスライド、メニュー、症例、お知らせ、ブログ、カテゴリ等 |
| **front-page.php** | 19, 69, 175, 198, 253, 473, 570, 588, 595 | 同上 |
| **archive-case.php** | 93, 117 | 症例ナビ select、症例カードリンク |
| **archive-menu.php** | 153, 226, 272 | 施術メニュー・料金パーツ・メニュー投稿へのリンク |
| **archive-news.php** | 31 | お知らせカードリンク |
| **archive-price.php** | 77 | 料金ナビ select の option value |
| **page-about.php** | - | （contact 等は home_url でスラッシュ付き） |
| **blocks/blog-block/blog-block.php** | 25, 48 | ブログスライドリンク |
| **blocks/case-block/case-block.php** | 29 | 症例カードリンク |
| **footer.php** | 291, 317 | メニュー・子メニュー投稿へのリンク |
| **home.php** | 85, 110 | ブログ一覧の記事リンク（post はフィルターでスラッシュ付き） |
| **category.php** | 86, 111 | カテゴリアーカイブ内の記事リンク |
| **single.php** | 118, 141, 168, 171, 174, 188, 196, 201 | 関連ブログ、シェアURL、前後記事、一覧へ戻る |
| **date.php** | - | 日付アーカイブ内リンク |
| **inc/search/search-post.php** | - | 検索結果の記事リンク |

### 2.3 ターム（カテゴリ等）URL `get_term_link()`

| ファイル | 行付近 | 用途 |
|----------|--------|------|
| **index.php** | 577 | ブログカテゴリリンク |
| **front-page.php** | 588 | 同上 |
| **home.php** | 103 | 同上 |
| **category.php** | 104 | 同上 |
| **date.php** | 118 | 同上 |
| **single.php** | 135 | 関連ブログのカテゴリ |
| **blocks/blog-block/blog-block.php** | 42 | ブログスライドのカテゴリ |
| **inc/search/search-post.php** | 84 | 検索結果のカテゴリ |

※  taxonomy の URL は環境によって末尾が `/` にならない場合があります。

### 2.4 ページネーションURL `get_pagenum_link()` / `get_blog_pagenum_link()`

| ファイル | 行付近 | 用途 |
|----------|--------|------|
| **archive-case.php** | 243, 262, 271 | 症例アーカイブのページ送り |
| **archive-news.php** | 73, 92, 101 | お知らせアーカイブのページ送り |
| **category.php** | 157, 176, 185 | カテゴリアーカイブのページ送り |
| **date.php** | 171, 190, 199 | 日付アーカイブのページ送り |
| **home.php** | 156, 175, 184 | ブログ一覧のページ送り（`get_blog_pagenum_link` はテーマでスラッシュ付きを返すため問題なし） |

※ `get_pagenum_link()` の戻り値は、パーマリンク設定次第で末尾が `/` にならない場合があります。

### 2.5 その他（外部・特殊スキーム）

- **tel:**, **mailto:**, **https://**（外部サイト）は対象外として除外しています。
- ACF の `the_sub_field('fvslide-url')`, `the_sub_field('mypage-login')`, `the_sub_field('line-resere')`, `the_sub_field('clinic-snslist-link')` 等は管理画面で入力される URL のため、必要に応じて運用で末尾 `/` を統一してください。
- `get_field('youtube', 'option')`, `get_field('instagram', 'option')`, `get_field('tiktok', 'option')`, `get_field('googlemap-link', ...)` も同様に設定値に依存します。

---

## 3. 対応方針の提案

1. **WordPress 側で統一する（推奨）**  
   - `functions.php` にフィルターを追加し、以下に `user_trailingslashit()` を適用する。  
     - `post_type_archive_link`（アーカイブURL）  
     - `post_type_link`（カスタム投稿タイプの単体URL）  
     - `term_link`（タームURL）  
     - ページネーション用の URL を生成している箇所があれば同様に `user_trailingslashit()` を適用  
   - あわせて、`template_redirect` で「末尾スラッシュなしでアクセスされた場合に、スラッシュ付きへ 301 リダイレクト」する処理を入れると、検索エンジンとユーザー両方で統一しやすくなります。

2. **テーマ内で出力時に統一する**  
   - 上記「2. 末尾スラッシュが付かない可能性がある箇所」の各出力で、  
     `echo esc_url( user_trailingslashit( get_permalink( ... ) ) );`  
     のように、取得した URL を `user_trailingslashit()` でラップしてから表示する。

3. **管理画面・運用**  
   - 管理画面「設定」→「パーマリンク」で、可能であれば「投稿名」などを選び、スラッシュ付きで表示される設定にする。  
   - ACF や「リンク」フィールドで入力する URL は、運用で末尾 `/` を統一する。

---

## 4. まとめ

- **すでにテーマ内で明示的に `home_url() . '/xxx/'` としている箇所は、末尾スラッシュ付きで統一できています。**
- **問題になり得るのは、次の WordPress 由来の URL です。**  
  - 投稿タイプアーカイブ: `get_post_type_archive_link('case')`（2箇所）  
  - 個別URL: `get_permalink()` / `get_the_permalink()` / `the_permalink()`（主に CPT: menu, case, doctor, news, price）  
  - ターム: `get_term_link()`  
  - ページネーション: `get_pagenum_link()`  

これらを `user_trailingslashit()` でラップするか、リダイレクトでスラッシュ付きに統一すると、URL末尾の `/` を一貫させられます。
