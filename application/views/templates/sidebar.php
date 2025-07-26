<style>
    body {
      margin: 0;
      background: #F8F8F9;
      font-family: 'Segoe UI', sans-serif;
    }

    .sidebar {
      position: fixed;
      top: 40px;
      left: 20px;
      height: calc(100% - 80px);
      width: 80px;
      background-color: #D4536C;
      border-radius: 20px;
      padding: 1rem 0.5rem;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
      z-index: 1050;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      transition: all 0.3s ease-in-out;
    }

    .sidebar .logo {
      text-align: center;
      font-size: 1.5rem;
      color: #fff;
      margin-bottom: 2rem;
    }

    .sidebar .logo span {
      display: none;
    }

    .nav-top,
    .nav-bottom {
      display: flex;
      flex-direction: column;
      gap: 1rem;
    }

    .sidebar .nav-link {
      color: #fff;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 1rem 0;
      height: 50px;
      border-radius: 10px;
      transition: background-color 0.2s;
      text-decoration: none;
    }

    .sidebar .nav-link:hover {
      background-color: #FEA4AA;
    }

    .sidebar .nav-link i {
      font-size: 1.6rem;
      margin: 0;
    }

    .sidebar .nav-link span {
      display: none;
    }

    .content-wrapper {
      margin-left: 110px;
      padding: 2rem;
      transition: margin-left 0.3s;
    }

    .burger-btn {
      display: none;
    }

    @media (max-width: 768px) {
      .sidebar {
        width: 60px;
        left: 10px;
        top: 10px;
        height: calc(100% - 20px);
        border-radius: 15px;
        padding: 0.5rem 0.25rem;
      }

      .sidebar .nav-link {
        padding: 0.75rem 0;
        height: 45px;
      }

      .sidebar .nav-link i {
        font-size: 1.4rem;
      }

      .content-wrapper {
        margin-left: 80px;
        padding: 1rem;
      }
    }

    .sidebar .nav-link.active {
      background-color: #F8F8F9;
      color: #D4536C;
      font-weight: bold;
    }

    .sidebar .nav-link.active i {
      color: #D4536C;
    }
  </style>
</head>
<body>
<div class="sidebar" id="sidebar">
    <div>
        <div class="logo">
            <i class="bi bi-journal-text"></i> <span></span> </div>
        <div class="nav-top">
            <a href="<?= base_url('home') ?>" class="nav-link <?= ($active === 'home') ? 'active' : '' ?>">
                <i class="bi bi-house"></i> <span></span>
            </a>
            <a href="<?= base_url('task') ?>" class="nav-link <?= ($active === 'task') ? 'active' : '' ?>">
                <i class="bi bi-check2-square"></i> <span></span>
            </a>
            <a href="<?= base_url('progress') ?>" class="nav-link <?= ($active === 'progress') ? 'active' : '' ?>">
                <i class="bi bi-bar-chart-line"></i> <span></span>
            </a>
        </div>
    </div>
    <div class="nav-bottom mb-2">
        <a href="#" class="nav-link" data-bs-toggle="modal" data-bs-target="#logoutConfirmModal">
    <i class="bi bi-box-arrow-right"></i>
</a>
    </div>
</div>

  <script>
    document.addEventListener('DOMContentLoaded', function () {
      const contentWrapper = document.querySelector('.content-wrapper');

      function adjustLayoutOnResize() {
        if (window.innerWidth <= 768) {
          if (contentWrapper) contentWrapper.style.marginLeft = '80px';
        } else {
          if (contentWrapper) contentWrapper.style.marginLeft = '110px';
        }
      }

      adjustLayoutOnResize();
      window.addEventListener('resize', adjustLayoutOnResize);
    });
  </script>
