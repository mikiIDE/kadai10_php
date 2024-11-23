-- テーブル作成（phpMyAdmin画面でタブをSQLへ切り替え→記述し実行すればOK！）
-- もしデータベースから作成する場合は、DBを先に作成してテーブル作成すること
CREATE TABLE code_links (
    id INT AUTO_INCREMENT PRIMARY KEY,
    pagename VARCHAR(255) NOT NULL,
    url VARCHAR(2048) NOT NULL,
    sort_html TINYINT(1) DEFAULT 0,
    sort_css TINYINT(1) DEFAULT 0,
    sort_js TINYINT(1) DEFAULT 0,
    sort_api TINYINT(1) DEFAULT 0,
    sort_php TINYINT(1) DEFAULT 0,
    sort_others TINYINT(1) DEFAULT 0,
    comment TEXT,
    password VARCHAR(60) NOT NULL,  -- ハッシュ化のため
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);