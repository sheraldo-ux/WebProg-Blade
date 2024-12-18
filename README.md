<!-- Improved compatibility of back to top link -->
<a id="readme-top"></a>

<!-- PROJECT SHIELDS -->
[![Contributors][contributors-shield]][contributors-url]
[![Forks][forks-shield]][forks-url]
[![Stargazers][stars-shield]][stars-url]
[![Issues][issues-shield]][issues-url]
[![MIT License][license-shield]][license-url]
[![LinkedIn][linkedin-shield]][linkedin-url]

<!-- PROJECT LOGO -->
<br />
<div align="center">
  <a href="https://github.com/sheraldo-ux/WebProg-Blade">
    <img src="public/logo.png" alt="Logo" width="80" height="80">
  </a>

  <h3 align="center">Web Pemetaan Banjir</h3>

  <p align="center">
    Aplikasi Prediksi dan Mitigasi Risiko Banjir
    <br />
    <a href="https://github.com/sheraldo-ux/WebProg-Blade"><strong>Explore the docs »</strong></a>
    <br />
    <br />
    <a href="https://github.com/sheraldo-ux/WebProg-Blade">View Demo</a>
    ·
    <a href="https://github.com/sheraldo-ux/WebProg-Blade/issues/new">Report Bug</a>
    ·
    <a href="https://github.com/sheraldo-ux/WebProg-Blade/issues/new">Request Feature</a>
  </p>
</div>

<!-- TABLE OF CONTENTS -->
<details>
  <summary>Table of Contents</summary>
  <ol>
    <li>
      <a href="#about-the-project">About The Project</a>
      <ul>
        <li><a href="#built-with">Built With</a></li>
      </ul>
    </li>
    <li>
      <a href="#getting-started">Getting Started</a>
      <ul>
        <li><a href="#prerequisites">Prerequisites</a></li>
        <li><a href="#installation">Installation</a></li>
      </ul>
    </li>
    <li><a href="#features">Features</a></li>
    <li><a href="#roadmap">Roadmap</a></li>
    <li><a href="#team">Team</a></li>
    <li><a href="#license">License</a></li>
    <li><a href="#contact">Contact</a></li>
    <li><a href="#acknowledgments">Acknowledgments</a></li>
  </ol>
</details>

<!-- ABOUT THE PROJECT -->
## About The Project

Dalam menghadapi tantangan perubahan iklim (SDG 13 - Climate Action), Indonesia sering mengalami bencana banjir yang semakin tidak terprediksi pola dan intensitasnya. Aplikasi Web Pemetaan Banjir dikembangkan untuk mengatasi masalah ini dengan menggunakan data historis banjir untuk menganalisis dan memprediksi risiko banjir di lokasi pengguna.

### Tujuan Utama
* Meningkatkan kesiapsiagaan masyarakat terhadap banjir
* Menyediakan sistem peringatan dini berbasis data
* Membantu masyarakat mengambil tindakan preventif
* Mengurangi potensi kerugian akibat banjir

<p align="right">(<a href="#readme-top">back to top</a>)</p>

### Built With

Teknologi utama yang digunakan dalam pengembangan proyek:

* [![Laravel][Laravel.com]][Laravel-url]
* [![Mapbox][Mapbox-shield]][Mapbox-url]
* [![Bootstrap][Bootstrap.com]][Bootstrap-url]
* [![PHP][PHP-shield]][PHP-url]
* [![JavaScript][JavaScript-shield]][JavaScript-url]
* [![MySQL][MySQL-shield]][MySQL-url]

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- GETTING STARTED -->
## Getting Started

Panduan untuk mengatur proyek di lingkungan lokal Anda.

### Prerequisites

Pastikan Anda memiliki prasyarat berikut:
* PHP 8.1
* Composer
* Node.js
* MySQL
  ```sh
  # Contoh instalasi Composer
  php -r "copy('https://getcomposer.org/installer', 'composer-setup.php');"
  php composer-setup.php
  php -r "unlink('composer-setup.php');"
  ```

### Installation

1. Clone repositori
   ```sh
   git clone https://github.com/sheraldo-ux/WebProg-Blade.git
   ```
2. Install dependensi Composer
   ```sh
   composer install
   ```
3. Install dependensi NPM
   ```sh
   npm install
   ```
4. Konfigurasi environment
   ```sh
   cp .env.example .env
   php artisan key:generate
   ```
5. Konfigurasi database
   ```sh
   php artisan migrate
   ```
6. Jalankan aplikasi
   ```sh
   npm run dev
   php artisan serve
   ```

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- FEATURES -->
## Features

### Halaman Utama (Home Page)
- Deteksi lokasi dengan koordinat GPS
- Perhitungan indeks banjir terdekat
- Prakiraan cuaca 12 jam ke depan
- Penanda peta risiko banjir

### Halaman Informasi
- Dampak banjir
- Kontak darurat
- Game Flood Myths and Facts

### Halaman Berita
- Form kontribusi berita
- Tampilan berita terbaru
- Sistem berbagi informasi banjir real-time

### Halaman Tips
- SMART Tips for Flood Survival
- Studi kasus nyata
- Video edukasi

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- ROADMAP -->
## Roadmap

- [x] Pengembangan prototipe awal
- [x] Implementasi sistem deteksi lokasi dan pemetaan banjir
- [x] Integrasi Mapbox API
- [x] Pengembangan fitur informasi banjir
- [x] Sistem kontribusi berita
- [x] Implementasi autentikasi pengguna
- [ ] Sistem kontribusi pelaporan titik banjir
- [ ] Dukungan multi-bahasa
    - [ ] Bahasa Indonesia
    - [ ] Bahasa Inggris

Lihat [open issues](https://github.com/sheraldo-ux/WebProg-Blade/issues) untuk daftar lengkap usulan fitur.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- TEAM -->
## Team

### Anggota Tim Pengembang

- **Pierre Adrian Tiopan Octavianus Sitoros**
  [![GitHub][github-shield]](https://github.com/PierreKoding)

- **Sheraldo Halim**
  [![GitHub][github-shield]](https://github.com/sheraldo-ux)

- **Raphaelle Albetho Wijaya**
  [![GitHub][github-shield]](https://github.com/Zweych)

- **Timothy Paendong**
  [![GitHub][github-shield]](https://github.com/voidt01)

- **Kevin Purnomo**
  [![GitHub][github-shield]](https://github.com/D9theCoder)

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- LICENSE -->
## License

Didistribusikan di bawah Lisensi MIT. Lihat `LICENSE.txt` untuk informasi lebih lanjut.

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- CONTACT -->
## Contact

Sheraldo Halim - [@sheraldo_ux](https://twitter.com/sheraldo_ux) - sheraldohalim@gmail.com

Link Proyek: [https://github.com/sheraldo-ux/WebProg-Blade](https://github.com/sheraldo-ux/WebProg-Blade)

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- ACKNOWLEDGMENTS -->
## Acknowledgments

Sumber daya yang membantu dalam pengembangan proyek:

* [Choose an Open Source License](https://choosealicense.com)
* [Img Shields](https://shields.io)
* [Google Font](https://fonts.google.com)

<p align="right">(<a href="#readme-top">back to top</a>)</p>

<!-- MARKDOWN LINKS & IMAGES -->
[contributors-shield]: https://img.shields.io/github/contributors/sheraldo-ux/WebProg-Blade.svg?style=for-the-badge
[contributors-url]: https://github.com/sheraldo-ux/WebProg-Blade/graphs/contributors
[forks-shield]: https://img.shields.io/github/forks/sheraldo-ux/WebProg-Blade.svg?style=for-the-badge
[forks-url]: https://github.com/sheraldo-ux/WebProg-Blade/network/members
[stars-shield]: https://img.shields.io/github/stars/sheraldo-ux/WebProg-Blade.svg?style=for-the-badge
[stars-url]: https://github.com/sheraldo-ux/WebProg-Blade/stargazers
[issues-shield]: https://img.shields.io/github/issues/sheraldo-ux/WebProg-Blade.svg?style=for-the-badge
[issues-url]: https://github.com/sheraldo-ux/WebProg-Blade/issues
[license-shield]: https://img.shields.io/github/license/sheraldo-ux/WebProg-Blade.svg?style=for-the-badge
[license-url]: https://github.com/sheraldo-ux/WebProg-Blade/blob/master/LICENSE.txt
[linkedin-shield]: https://img.shields.io/badge/-LinkedIn-black.svg?style=for-the-badge&logo=linkedin&colorB=555
[linkedin-url]: https://linkedin.com/in/sheraldo-halim

[Laravel.com]: https://img.shields.io/badge/Laravel-FF2D20?style=for-the-badge&logo=laravel&logoColor=white
[Laravel-url]: https://laravel.com
[Mapbox-shield]: https://img.shields.io/badge/Mapbox-000000?style=for-the-badge&logo=mapbox&logoColor=white
[Mapbox-url]: https://www.mapbox.com/
[Bootstrap.com]: https://img.shields.io/badge/Bootstrap-563D7C?style=for-the-badge&logo=bootstrap&logoColor=white
[Bootstrap-url]: https://getbootstrap.com

[PHP-shield]: https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white
[PHP-url]: https://www.php.net/
[JavaScript-shield]: https://img.shields.io/badge/JavaScript-F7DF1E?style=for-the-badge&logo=javascript&logoColor=black
[JavaScript-url]: https://developer.mozilla.org/en-US/docs/Web/JavaScript
[MySQL-shield]: https://img.shields.io/badge/MySQL-4479A1?style=for-the-badge&logo=mysql&logoColor=white
[MySQL-url]: https://www.mysql.com/

[github-shield]: https://img.shields.io/badge/GitHub-100000?style=for-the-badge&logo=github&logoColor=white
