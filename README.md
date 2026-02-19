# 🐳 スケーラブルDocker環境

複数のWordPressプロジェクトを簡単に管理できるDocker環境です。

## 📁 ディレクトリ構造

```
docker/
├── docker-compose.yml          # メインのDocker Compose設定
├── env.example                 # 環境変数設定例
├── scripts/                    # 管理用スクリプト
│   ├── add-project.sh         # 新プロジェクト追加
│   ├── start-project.sh       # プロジェクト起動
│   ├── stop-project.sh        # プロジェクト停止
│   └── list-projects.sh       # プロジェクト一覧表示
├── templates/                  # プロジェクトテンプレート
│   └── wordpress/             # WordPressテンプレート
├── projects/                   # 各プロジェクト
│   ├── jun-clinic/            # 既存プロジェクト
│   └── test/                  # テストプロジェクト
└── shared/                     # 共有リソース
    ├── mysql/                 # 共有MySQL設定
    └── nginx/                 # リバースプロキシ設定
```

## 🚀 クイックスタート

### 1. 環境の起動
```bash
# 全プロジェクトを起動
./scripts/start-project.sh

# または直接Docker Composeを使用
docker-compose up -d
```

### 2. プロジェクト一覧の確認
```bash
./scripts/list-projects.sh
```

### 3. アクセス
- **jun-clinic**: http://localhost:10090
- **test**: http://localhost:10091
- **phpMyAdmin**: http://localhost:8080

## 🔧 管理コマンド

### 新しいプロジェクトの追加
```bash
./scripts/add-project.sh <プロジェクト名>
```

例：
```bash
./scripts/add-project.sh my-new-site
```

### プロジェクトの起動・停止
```bash
# 全プロジェクト起動
./scripts/start-project.sh

# 特定のプロジェクト起動
./scripts/start-project.sh <プロジェクト名>

# 全プロジェクト停止
./scripts/stop-project.sh

# 特定のプロジェクト停止
./scripts/stop-project.sh <プロジェクト名>
```

### プロジェクト一覧表示
```bash
./scripts/list-projects.sh
```

## 🌐 ポート管理

プロジェクトは以下のポートでアクセス可能です：

- **10090**: プロジェクト1 (jun-clinic)
- **10091**: プロジェクト2 (test)
- **10092**: プロジェクト3 (新規追加時)
- **10093**: プロジェクト4 (新規追加時)
- ...
- **8080**: phpMyAdmin
- **3306**: MySQL (直接接続時)

## 🗄️ データベース

- **共有MySQL**: 全プロジェクトで共有
- **データベース名**: プロジェクト名に基づいて自動生成
- **ユーザー**: wp_user
- **パスワード**: wppassword

## 📝 環境変数

`env.example` をコピーして `.env` を作成し、必要に応じて設定を変更してください：

```bash
cp env.example .env
```

## 🛠️ トラブルシューティング

### ポートが使用中の場合
```bash
# 使用中のポートを確認
lsof -i :10090

# プロセスを終了
kill -9 <PID>
```

### コンテナの再構築
```bash
# 全コンテナを停止・削除
docker-compose down

# イメージも削除
docker-compose down --rmi all

# 再起動
docker-compose up -d
```

### データベースのリセット
```bash
# ボリュームも削除
docker-compose down -v

# 再起動
docker-compose up -d
```

## 🔒 セキュリティ

- 本番環境では必ずパスワードを変更してください
- セキュリティキーは自動生成されます
- 不要なポートは公開しないでください

## 📚 追加情報

- WordPressの初期設定は各プロジェクトのURLにアクセスして行います
- テーマやプラグインは各プロジェクトの `wp-content` ディレクトリに配置します
- バックアップは定期的に `projects/` ディレクトリをバックアップしてください


# HashimotoClinic.
# HashimotoClinic.
