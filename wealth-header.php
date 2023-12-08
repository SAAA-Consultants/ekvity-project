 <!-- navbar componet -->
 <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
    <div class="container-fluid ps-5">
      <a class="navbar-brand" href="../index.php"><img src="./img/images/Updted EKVITY LOGO 1.png" width="180px"
          alt=""></a>
      <div class="d-lg-none">
        <!-- Button for screens below 992px -->
        <button class="navbar-toggler btn btn-link border-0" type="button" data-bs-toggle="offcanvas"
          data-bs-target="#offcanvasRight-1" aria-controls="offcanvasRight" aria-expanded="false"
          aria-label="Toggle navigation">
          <svg width="36" height="18" viewBox="0 0 46 28" fill="none" xmlns="http://www.w3.org/2000/svg">
            <circle cx="23" cy="14" r="2" fill="#D9D9D9" />
            <line y1="2" x2="36" y2="2" stroke="#1D1D1D" stroke-width="4" />
            <line y1="14" x2="36" y2="14" stroke="#1D1D1D" stroke-width="4" />
            <line y1="26" x2="36" y2="26" stroke="#1D1D1D" stroke-width="4" />
          </svg>
        </button>
      </div>
      <div class="offcanvas offcanvas-end" style="width: 100%; max-width: none;" tabindex="-1" id="offcanvasRight-1"
        aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasRightLabel"></h5>
          <button type="button" class="btn m-5" data-bs-dismiss="offcanvas" aria-label="Close">
            <svg width="31" height="28" viewBox="0 0 31 28" fill="none" xmlns="http://www.w3.org/2000/svg">
              <line x1="26.5858" y1="12.7052" x2="15.5858" y2="1.70523" stroke="white" stroke-width="4" />
              <line x1="25.8257" y1="13.5645" x2="0.825684" y2="13.5645" stroke="white" stroke-width="4" />
              <line y1="-2" x2="19.3384" y2="-2"
                transform="matrix(-0.704372 0.709831 -0.704372 -0.709831 27.2729 10.5469)" stroke="white"
                stroke-width="4" />
            </svg>
          </button>
        </div>
        <div class="offcanvas-body">
          <div class="offcan-menus">
            <a href="/" class="offcan-menu-item">HOME</a>
            <a href="./about.php" class="offcan-menu-item">ABOUT US</a>
            <div class="accordion accordion-flush" id="accordionFlushExample">
              <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingOne">
                  <button class="accordion-button collapsed offcan-menu-item" type="button" data-bs-toggle="collapse"
                    data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                    SERVICES
                  </button>
                </h2>
                <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                  data-bs-parent="#accordionFlushExample">
                  <div class="accordion-body">
                    <a href="./pre-ipo.php">PRE-IPO</a>
                    <hr>
                    <a href="./services/wealth-management.php">Wealth Management</a>
                  </div>
                </div>
              </div>
            </div>
            <a href="https://focg.ekvity.com" class="offcan-menu-item">FOCG</a>
            <a href="./our-team/our-team.php" class="offcan-menu-item">OUR TEAM</a>
            <a href="./faq's/faq.php" class="offcan-menu-item">FAQs</a>
            <a href="./carrier.php" class="offcan-menu-item">CAREERS</a>
            <div class="accordion accordion-flush" id="accordionFlushExample2">
              <div class="accordion-item">
                <h2 class="accordion-header" id="flush-headingTwo">
                  <button class="accordion-button collapsed offcan-menu-item" type="button" data-bs-toggle="collapse"
                    data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
                    FORUMS
                  </button>
                </h2>
                <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo"
                  data-bs-parent="#accordionFlushExample2">
                  <div class="accordion-body">
                    <a href="./blog.php">BLOGS</a>
                    <hr>
                    <a href="./our-conclave.php">CONCLAVE</a>
                  </div>
                </div>
              </div>
            </div>
            <a href="./contact.php" class="offcan-menu-item">CONTACT</a>
          </div>
        </div>
      </div>
      <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a class="nav-link d-flex " href="about.php">ABOUT US</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
              data-bs-toggle="dropdown" aria-expanded="false">
              SERVICES
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="./pre-ipo.php">PRE-IPO</a>
              </li>
              <hr>
              <li><a class="dropdown-item" href="./services/wealth-management.php">WEALTH MANAGEMENT</a></li>
            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="https://focg.ekvity.com/">FOCG</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button"
              data-bs-toggle="dropdown" aria-expanded="false">
              FORUMS
            </a>
            <ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
              <li><a class="dropdown-item" href="./blog.php">BLOG</a>
              </li>
              <hr>
              <li><a class="dropdown-item" href="./our-conclave.php">CONCLAVE</a></li>

            </ul>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="./carrier.php">CAREERS</a>
          </li>
        </ul>
      </div>
    </div>
    <div class="d-none d-lg-block">
      <button class="btn btn-link border-0" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight"
        aria-controls="offcanvasRight">
        <svg width="36" height="18" viewBox="0 0 46 28" fill="none" xmlns="http://www.w3.org/2000/svg">
          <circle cx="23" cy="14" r="2" fill="#D9D9D9" />
          <line y1="2" x2="36" y2="2" stroke="#1D1D1D" stroke-width="4" />
          <line y1="14" x2="36" y2="14" stroke="#1D1D1D" stroke-width="4" />
          <line y1="26" x2="36" y2="26" stroke="#1D1D1D" stroke-width="4" />
        </svg>
      </button>
    </div>
  </nav>
  <div class="offcanvas offcanvas-end" style="width: 100%; max-width: none;" tabindex="-1" id="offcanvasRight"
    aria-labelledby="offcanvasRightLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasRightLabel"></h5>
      <button type="button" class="btn m-5" data-bs-dismiss="offcanvas" aria-label="Close">
        <svg width="31" height="28" viewBox="0 0 31 28" fill="none" xmlns="http://www.w3.org/2000/svg">
          <line x1="26.5858" y1="12.7052" x2="15.5858" y2="1.70523" stroke="white" stroke-width="4" />
          <line x1="25.8257" y1="13.5645" x2="0.825684" y2="13.5645" stroke="white" stroke-width="4" />
          <line y1="-2" x2="19.3384" y2="-2" transform="matrix(-0.704372 0.709831 -0.704372 -0.709831 27.2729 10.5469)"
            stroke="white" stroke-width="4" />
        </svg>
      </button>
    </div>
    <div class="offcanvas-body">
      <div class="offcan-menus">
        <a href="./index.php" class="offcan-menu-item">HOME</a>
        <a href="./our-team/our-team.php" class="offcan-menu-item">OUR TEAM</a>
        <a href="./faq's/faq.php" class="offcan-menu-item">FAQs</a>
        <a href="./contact.php" class="offcan-menu-item">CONTACT</a>
      </div>
    </div>
  </div>
  <div class="nav position-fixed d-flex text-center justify-content-center">
    <ul class="justify-content-center d-flex">
      <li class="nav-item mx-2">
        <a class="nav-link active" aria-current="page" href="./grievance-mechnism/gievance-mechanism.php">Grievance
          Mechanism</a>
      </li>
      <li class="nav-item mx-2">
        <a class="nav-link" href="./investor-charter/investor-charter.php">Investor Charter</a>
      </li>

      <li class="nav-item mx-2">
        <a class="nav-link" href="./complaints-status/complaints-status.php">Complaints Status</a>
      </li>
      <li class="nav-item mx-2">
        <a class="nav-link" href="./Regulatory-disclosure/regulatory-disclosure.php">Regulatory Disclosures</a>
      </li>

    </ul>
  </div>
  <!-- End of navbar -->