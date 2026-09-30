-- Database DOA Coffee
-- Struktur CRUD dipertahankan: admin + produk.
-- Data produk mengikuti Product Catalog 2026.
-- Kolom stok tidak tersedia pada sumber katalog, sehingga nilai awal dibuat 0
-- dan dapat diperbarui melalui dashboard admin.

CREATE DATABASE IF NOT EXISTS `doa_coffee1`;
USE `doa_coffee1`;

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET NAMES utf8mb4;

CREATE TABLE `admin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `produk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama` varchar(100) NOT NULL,
  `kategori` varchar(80) NOT NULL,
  `deskripsi` text NOT NULL,
  `harga` decimal(12,2) NOT NULL,
  `stok` int(11) NOT NULL DEFAULT 0,
  `gambar` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

INSERT INTO `admin` (`nama`, `username`, `password`) VALUES
('Administrator Doa Coffee', 'admin', '$2y$10$98vbxh4xT65X0Rnc9/L33eWkPdxz8VL4hbvd338D7IILqDOqYj4e6');

INSERT INTO `produk` (`nama`, `kategori`, `deskripsi`, `harga`, `stok`, `gambar`) VALUES
('Robusta Coffee', 'Robusta', '100% Robusta Coffee. Tumbuh di kawasan Pegunungan Argopuro dengan karakter rasa kuat, body tebal, cita rasa cokelat, kacang, sedikit rempah, dan tingkat keasaman rendah. Proses: Dry Coffee, Dry Hulling, Medium-Dark Roast.', 50000, 0, 'robusta.jpg'),
('Arabica Wine Coffee', 'Arabika Wine', '100% Arabica Wine Coffee. Arabika Argopuro dengan karakter kompleks, aroma floral dan fruity, kemanisan alami, acidity seimbang, dan aftertaste panjang. Proses: Dry Coffee, Dry Hulling, Medium-Dark Roast.', 150000, 0, 'arabica_wine.jpg'),
('Arabica Natural Coffee', 'Arabika Natural', '100% Arabica Natural Coffee. Menghadirkan karakter rasa Arabika Argopuro dengan proses Natural. Net weight 200 gr dan Medium-Dark Roast.', 100000, 0, 'arabica_natural.jpg'),
('Arabica Fullwash Coffee', 'Arabika Fullwash', '100% Arabica Fullwash Coffee. Arabika Argopuro dengan proses Fullwash, Dry Hulling, dan Medium-Dark Roast. Net weight 200 gr.', 75000, 0, 'arabica_fullwash.jpg'),
('Arabica Yellow Caturra Coffee', 'Arabika Yellow Caturra', '100% Arabica Yellow Caturra Coffee. Produk Arabika dengan proses Dry, Dry Hulling, dan Medium-Dark Roast. Net weight 200 gr.', 150000, 0, 'yellow_caturra.jpg'),
('Luwak Arabica Coffee', 'Luwak Arabica', '100% Luwak Arabica Coffee. Produk Arabika dengan proses Dry, Dry Hulling, dan Medium-Dark Roast. Net weight 200 gr.', 250000, 0, 'luwak_arabica.jpg'),
('Excelsa Coffee', 'Excelsa', '100% Excelsa Coffee. Tumbuh pada kawasan Pegunungan Argopuro dengan perpaduan cita rasa fruity, asam segar, sedikit rempah, karakter eksotis, dan body khas. Natural Process, Dry Hulling, Medium-Dark Roast.', 100000, 0, 'excelsa.jpg');
