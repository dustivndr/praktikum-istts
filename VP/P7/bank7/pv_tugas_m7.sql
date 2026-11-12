-- Banking Database Schema
DROP DATABASE IF EXISTS pv_tugas_m7;
CREATE DATABASE pv_tugas_m7;
USE pv_tugas_m7;

-- User table
CREATE TABLE user (
	id INT AUTO_INCREMENT PRIMARY KEY,
	nama VARCHAR(150),
	norek VARCHAR(20) UNIQUE,
	saldo DECIMAL(15, 2) DEFAULT 0
);

-- Transaction Log table
CREATE TABLE log_transaksi (
	id INT AUTO_INCREMENT PRIMARY KEY,
	user_id INT,
	jenis_transaksi VARCHAR(50), -- 'Transfer Keluar' or 'Transfer Masuk'
	jumlah DECIMAL(15, 2),
	user_tujuan_id INT,
	tanggal_transaksi DATETIME DEFAULT CURRENT_TIMESTAMP,
	FOREIGN KEY (user_id) REFERENCES user(id),
	FOREIGN KEY (user_tujuan_id) REFERENCES user(id)
);

-- Insert sample data
INSERT INTO user (nama, norek, saldo) VALUES
('John', '1001', 1000000),
('Harold', '1002', 500000),
('Cecil', '1003', 750000),
('Yujin', '1004', 600000),
('Walter', '1005', 900000);

INSERT INTO log_transaksi (user_id, jenis_transaksi, jumlah, user_tujuan_id) VALUES
(1, 'Transfer Keluar', 50000, 2),
(2, 'Transfer Masuk', 50000, 1),
(5, 'Transfer Keluar', 250000, 1),
(1, 'Transfer Masuk', 250000, 5),
(3, 'Transfer Keluar', 75000, 4),
(4, 'Transfer Masuk', 75000, 3);
