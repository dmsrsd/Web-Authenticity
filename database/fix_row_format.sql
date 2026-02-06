-- Jalankan di WSL: sudo mysql gridsf < fix_row_format.sql
-- Atau: mysql -u root -p gridsf < fix_row_format.sql

-- 1. Default untuk tabel baru
SET GLOBAL innodb_default_row_format = 'DYNAMIC';

-- 2. Ubah tabel yang error ke DYNAMIC (supaya ALTER ADD COLUMN tidak gagal)
ALTER TABLE member_old ROW_FORMAT=DYNAMIC;
ALTER TABLE `order` ROW_FORMAT=DYNAMIC;
ALTER TABLE website ROW_FORMAT=DYNAMIC;

-- 3. Opsional: ubah semua tabel di gridsf ke DYNAMIC
-- SET @db = 'gridsf';
-- SET @q = (SELECT GROUP_CONCAT('ALTER TABLE `', TABLE_NAME, '` ROW_FORMAT=DYNAMIC;' SEPARATOR ' ') FROM information_schema.TABLES WHERE TABLE_SCHEMA = @db AND ENGINE = 'InnoDB');
-- PREPARE stmt FROM @q; EXECUTE stmt; DEALLOCATE PREPARE stmt;
