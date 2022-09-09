# week8-team-project
week8 team project
## 本のレンタルアプリ
- 本の貸し借りの管理ができるアプリ
- ログイン画面：メールアドレス・パスワードで認証し、管理者と一般ユーザーを識別
- 新規登録画面：登録されていない人はここで登録
- 一覧ページ：本の貸し出し状況が分かるページ
- マイページ：自分の借りている本の一覧、返却はここで操作
- 管理者ページ：貸し出し状況一覧、本の追加、管理者と一般ユーザーのロールの変更操作

## 使用技術
- フロントエンド:Next.js
- バックエンド:Laravel
- データベース:MySQL

## できている所
- ログイン認証をして、管理者と一般ユーザーを識別。管理者は本の新規追加、ロールの変更ができる
- CRUD（貸し出し一覧：GET、本の追加：POST、本の返却・ロールの変更：PUT）
- トランザクションがある
- APIの一部のテストを実施
## できていない所
- フロントのテスト
- cssの実装
- AWSでのAPI取得
